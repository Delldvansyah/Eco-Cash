<?php
session_start();
if (empty($_SESSION['user_n']) && empty($_SESSION['pass_n'])) {
    header('location:login.php');
    exit();
}
error_reporting(E_ALL | E_STRICT);
include_once("E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nasabah</title>
    <link rel="stylesheet" href="http://localhost/Eco-Cash/asset/internal/css/style_2.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway:700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://localhost/Eco-Cash/asset/internal/img/img-local/favicon.ico">
    <style>
        button {
            height: 27px;
            width: 85px;
            background: #8cd91a;
            border-radius: 5px;
            color: #fff;
            font-family: Montserrat;
        }
        form {
            margin: 20px;
        }
        label {
            font-family: Montserrat;
            font-size: 18px;
            display: block;
            color: #262626;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: auto;
            background-color: #8cd91a;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        #gambar-sampah {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 20px;
        }
    </style>
    <script>
        function updateGambar() {
            var jenisSampah = document.getElementById("jenis_sampah").value;
            var gambarSampah = document.getElementById("gambar-sampah");
            var gambarPath = "http://localhost/Eco-Cash/asset/internal/img/uploads/";

            // Ganti URL gambar sesuai dengan jenis sampah yang dipilih
            gambarSampah.src = gambarPath + jenisSampah + ".png";
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li>
                <a href="nasabah.php?page=data-nasabah" style="text-align: center; padding: 30px 0 30px 0; font-size: 20px;">Nasabah, <?php echo $_SESSION['user_n']; ?></a>
            </li>
            <li>
                <a href="nasabah.php?page=form-setor-sampah"><span class="fa fa-trash" aria-hidden="true"></span>Setor Sampah</a>
            </li>
            <li>
                <a href="nasabah.php?page=histori-setor"><span class="fa fa-handshake-o" aria-hidden="true"></span>Histori Setor</a>
            </li>
            <li>
                <a href="nasabah.php?page=histori-tarik"><span class="fa fa-handshake-o" aria-hidden="true"></span>Histori Tarik</a>
            </li>
            <li>
                <a href="logout.php"><span class="fa fa-sign-out" aria-hidden="true"></span>Logout</a>
            </li>
        </ul>
    </div>

    <div class="box-1">
        <section>
            <?php 
            if(isset($_GET['page'])){
                $page = $_GET['page'];

                switch ($page) {
                    case 'data-nasabah':
                        include "E:/xampp/htdocs/Eco-Cash/system/function/view-nasabah.php";
                        break;
                    case 'form-setor-sampah':
                        include "E:/xampp/htdocs/Eco-Cash/system/function/form-setor-sampah.php";
                        break;
                    case 'histori-setor':
                        include "E:/xampp/htdocs/Eco-Cash/system/function/histori-setor.php";
                        break;
                    case 'histori-tarik':
                        include "E:/xampp/htdocs/Eco-Cash/system/function/histori-tarik.php";
                        break;
                    case 'edit-nasabah':
                        include "E:/xampp/htdocs/Eco-Cash/system/function/edit-nasabah.php";
                        break;          
                    default:
                        echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                        break;
                }
            } else {
                include "E:/xampp/htdocs/Eco-Cash/system/function/view-nasabah.php";
            }
            ?>
        </section>
    </div>
</body>
</html>
