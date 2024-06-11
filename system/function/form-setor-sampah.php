<?php

include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if (!isset($_SESSION['user_n'])) {
    header("Location: login.php");
    exit();
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
        echo "<script>alert('Data berhasil disimpan'); window.location='nasabah.php?page=histori-setor';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
    }
}

// Ambil data jenis sampah untuk dropdown
$jenis_sampah_query = "SELECT * FROM sampah ORDER BY jenis_sampah ASC";
$jenis_sampah_result = mysqli_query($conn, $jenis_sampah_query);
?>

<h2 style="font-size: 30px; color: #262626;">Form Setor Sampah</h2>
<form action="" method="POST">
    <label for="jenis_sampah">Jenis Sampah</label>
    <select id="jenis_sampah" name="jenis_sampah" onchange="updateGambar()" required>
        <option value="" disabled selected>Pilih jenis sampah</option>
        <?php while ($row = mysqli_fetch_assoc($jenis_sampah_result)) { ?>
            <option value="<?php echo htmlspecialchars($row['jenis_sampah'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($row['jenis_sampah'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php } ?>
    </select>

    <img id="gambar-sampah" src="" alt="Gambar Sampah" style="display: none;">

    <label for="berat">Berat (kg)</label>
    <input type="number" id="berat" name="berat" step="0.01" min="0" required>

    <input type="submit" value="Setor Sampah">
</form>

<script>
    function updateGambar() {
        var jenisSampah = document.getElementById("jenis_sampah").value;
        var gambarSampah = document.getElementById("gambar-sampah");
        var gambarPath = "http://localhost/Eco-Cash/asset/internal/img/uploads/";
        var extensions = ['.png', '.jpg', '.jpeg'];

        // Coba semua ekstensi gambar untuk jenis sampah yang dipilih
        for (var i = 0; i < extensions.length; i++) {
            var imgSrc = gambarPath + jenisSampah.toLowerCase() + extensions[i];
            var img = new Image();
            img.onload = function() {
                gambarSampah.src = imgSrc;
                gambarSampah.style.display = 'block';
            };
            img.onerror = function() {
                gambarSampah.style.display = 'none';
            };
            img.src = imgSrc;
            if (img.complete) {
                break;
            }
        }
    }
</script>
