<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
    header('location:login.php');
    exit();
}

error_reporting(E_ALL | E_STRICT);
include_once("E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php");

if (isset($_POST['simpan'])) {
    $jenis_sampah = $_POST['jenis_sampah'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Memeriksa apakah file gambar diunggah
    if (isset($_FILES["gambar"]["tmp_name"]) && $_FILES["gambar"]["tmp_name"] != "") {
        $nama_file = $_FILES['gambar']['name'];
        $source = $_FILES['gambar']['tmp_name'];
        $folder = 'E:/xampp/htdocs/Eco-Cash/asset/internal/img/uploads/'; // Gunakan path absolut untuk folder

        // Pindahkan file gambar ke folder yang ditentukan
        if (move_uploaded_file($source, $folder.$nama_file)) {
            // Gunakan prepared statement untuk mencegah SQL Injection
            $query = $conn->prepare("UPDATE sampah SET harga=?, gambar=?, deskripsi=? WHERE jenis_sampah=?");
            $query->bind_param("isss", $harga, $nama_file, $deskripsi, $jenis_sampah);
            $query->execute();
        }
    } else {
        // Gunakan prepared statement untuk mencegah SQL Injection
        $query = $conn->prepare("UPDATE sampah SET harga=?, deskripsi=? WHERE jenis_sampah=?");
        $query->bind_param("iss", $harga, $deskripsi, $jenis_sampah);
        $query->execute();
    }

    if ($query) {
        echo "
            <script>
              alert('Berhasil Mengubah Data!');
            </script>
            ";
        // Redirect ke halaman setelah berhasil
        echo "<meta http-equiv='refresh' content='0; url=http://localhost/Eco-Cash/page/admin.php?page=data-sampah'>";
    } else {
        echo "
            <script>
              alert('Gagal Mengubah Data!');
            </script>
            ";
        // Redirect ke halaman setelah gagal
        echo "<meta http-equiv='refresh' content='0; url=http://localhost/Eco-Cash/page/admin.php?page=data-sampah'>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Data Sampah</title>
    <!--link datatables-->
    <style>
        label {
            font-family: Montserrat;
            font-size: 18px;
            display: block;
            color: #262626;
        }
        input[type=text], input[type=password], input[type=file] {
            border-radius: 5px;
            width: 40%;
            height: 35px;
            background: #eee;
            padding: 0 10px;
            box-shadow: 1px 2px 2px 1px #ccc;
            color: #262626;
        }
        input[type=submit] {
            height: 35px;
            width: 200px;
            background: #8cd91a;
            border-radius: 20px;
            color: #fff;
            margin-top: 20px;
            cursor: pointer;
        }
        .form-group {
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <h2 style="font-size: 30px; color: #262626;">Edit Data Sampah</h2>

    <?php if (isset($_GET['jenis_sampah'])) { 
        $jenis_sampah = $_GET['jenis_sampah'];
        $cek = $conn->prepare("SELECT * FROM sampah WHERE jenis_sampah=?");
        $cek->bind_param("s", $jenis_sampah);
        $cek->execute();
        $result = $cek->get_result();
        $row = $result->fetch_assoc();
    ?>
  
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Jenis Sampah</label>
            <input type="text" name="jenis_sampah" value="<?php echo $row['jenis_sampah']; ?>" readonly />
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" name="harga" value="<?php echo $row['harga']; ?>" required />
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" />
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" value="<?php echo $row['deskripsi']; ?>" required />
        </div>
        <input type="submit" name="simpan" value="Simpan Data" />
    </form>
     
    <?php } ?>

</body>
</html>
