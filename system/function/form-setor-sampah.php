<?php
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Pastikan session_start() hanya dipanggil jika session belum dimulai
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_sampah = $_POST['jenis_sampah'];
    $berat = $_POST['berat'];
    $tanggal_setor = date('Y-m-d');
    $user_id = $_SESSION['user_n'];

    // Ambil harga sampah berdasarkan jenis
    $harga_query = mysqli_query($conn, "SELECT harga FROM sampah WHERE jenis_sampah = '$jenis_sampah'");
    $harga_row = mysqli_fetch_assoc($harga_query);
    $harga = $harga_row['harga'];
    $total = $berat * $harga;

    // Query untuk memasukkan data setor sampah
    $query = "INSERT INTO setor (nin, jenis_sampah, berat, harga, total, tanggal_setor, nia) VALUES ('$user_id', '$jenis_sampah', '$berat', '$harga', '$total', '$tanggal_setor', 'NIA')";
    if (mysqli_query($conn, $query)) {
        // Update saldo user setelah setor
        $saldo_query = "UPDATE nasabah SET saldo = saldo + $total WHERE nin = '$user_id'";
        mysqli_query($conn, $saldo_query);

        // Ambil ID setoran yang baru ditambahkan
        $id_setor = mysqli_insert_id($conn);

        // Kirim respon JSON
        echo json_encode(['success' => true, 'id_setor' => $id_setor, 'tanggal_setor' => $tanggal_setor, 'harga' => $harga, 'total' => $total]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}

// Ambil data jenis sampah untuk dropdown
$jenis_sampah_query = "SELECT * FROM sampah ORDER BY jenis_sampah ASC";
$jenis_sampah_result = mysqli_query($conn, $jenis_sampah_query);
?>

<h2 style="font-size: 30px; color: #262626;">Form Setor Sampah</h2>
<form id="form-setor" method="POST">
    <label for="jenis_sampah">Jenis Sampah</label>
    <select id="jenis_sampah" name="jenis_sampah" onchange="updateGambar()" required>
        <option value="" disabled selected>Pilih jenis sampah</option>
        <?php while ($row = mysqli_fetch_assoc($jenis_sampah_result)) { ?>
            <option value="<?php echo htmlspecialchars($row['jenis_sampah'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($row['jenis_sampah'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php } ?>
    </select>

    <img id="gambar-sampah" src="" alt="Gambar Sampah" style="max-width: 200px; max-height: 200px;">

    <label for="berat">Berat (kg)</label>
    <input type="number" id="berat" name="berat" step="0.01" min="0" required>

    <input type="submit" value="Setor Sampah">
</form>

<script>
    function updateGambar() {
        var jenisSampah = document.getElementById("jenis_sampah").value;
        var gambarSampah = document.getElementById("gambar-sampah");
        var gambarPath = "http://localhost/Eco-Cash/asset/internal/img/uploads/";

        var jpgImage = new Image();
        jpgImage.src = gambarPath + jenisSampah.toLowerCase() + ".jpg";
        jpgImage.onload = function() {
            gambarSampah.src = jpgImage.src;
        }
        jpgImage.onerror = function() {
            var pngImage = new Image();
            pngImage.src = gambarPath + jenisSampah.toLowerCase() + ".png";
            pngImage.onload = function() {
                gambarSampah.src = pngImage.src;
            }
            pngImage.onerror = function() {
                gambarSampah.src = "";
            }
        }
    }

    document.getElementById("form-setor").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        
        fetch("http://localhost/Eco-Cash/system/function/form-setor-sampah.php", {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil disimpan');
                
                // Kode untuk mengupdate tabel view setor secara dinamis
                var table = parent.document.getElementById("example").getElementsByTagName('tbody')[0];
                var newRow = table.insertRow();
                
                // Tambahkan data baru ke tabel
                newRow.insertCell(0).innerText = data.id_setor; // ID baru
                newRow.insertCell(1).innerText = data.tanggal_setor; // Tanggal Setor
                newRow.insertCell(2).innerText = '<?php echo $user_id; ?>'; // NIN
                newRow.insertCell(3).innerText = document.getElementById("jenis_sampah").value; // Jenis Sampah
                newRow.insertCell(4).innerText = document.getElementById("berat").value + ' Kg'; // Berat
                newRow.insertCell(5).innerText = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.harga); // Harga
                newRow.insertCell(6).innerText = 'Rp. ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.total); // Total
                newRow.insertCell(7).innerText = 'NIA'; // NIA
                var aksiCell = newRow.insertCell(8);
                aksiCell.innerHTML = '<a href="admin.php?page=edit-setor&id=' + data.id_setor + '"><button><i class="fa fa-pencil"></i>edit</button></a>' +
                                     '<a onclick="return confirm(\'Anda yakin ingin menghapus data ini?\')" href="http://localhost/Eco-Cash/system/function/delete-setor.php?id=' + data.id_setor + '"><button><i class="fa fa-trash-o"></i>hapus</button></a>';
            } else {
                alert('Data gagal disimpan');
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    });
</script>
