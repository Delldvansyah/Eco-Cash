<?php
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if ($user == "" || $pass == "") {
        echo "
        <script>
            alert('Username dan Password tidak boleh kosong!');
            document.location.href ='login.php';
        </script>
        ";
        exit();
    }

    // Check admin
    $data_admin = mysqli_query($conn, "SELECT * FROM admin WHERE nia = '$user' AND password = '$pass'");
    if (!$data_admin) {
        die("Query error: " . mysqli_error($conn));
    }
    $cek_admin = mysqli_num_rows($data_admin);
    $a = mysqli_fetch_array($data_admin);

    // Check nasabah
    $data_nasabah = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin = '$user' AND password = '$pass'");
    if (!$data_nasabah) {
        die("Query error: " . mysqli_error($conn));
    }
    $cek_user = mysqli_num_rows($data_nasabah);
    $n = mysqli_fetch_array($data_nasabah);

    if ($cek_admin > 0) {
        $_SESSION['level'] = $a['level'];
        $_SESSION['nama'] = $a['nama'];
        $_SESSION['email'] = $a['email'];
        $_SESSION['telepon'] = $a['telepon'];
        $_SESSION['nia'] = $a['nia'];
        echo "
        <script>
            alert('Selamat Anda berhasil login!');
            document.location.href ='admin.php';
        </script>
        ";
        exit();
    } else if ($cek_user > 0) {
        $_SESSION['user_n'] = $n['nama']; // Pastikan user_n diinisialisasi
        $_SESSION['email_n'] = $n['email'];
        $_SESSION['pass_n'] = $n['password'];
        $_SESSION['telepon_n'] = $n['telepon'];
        $_SESSION['nin'] = $n['nin'];
        $_SESSION['rt'] = $n['rt'];
        $_SESSION['alamat'] = $n['alamat'];
        $_SESSION['saldo'] = $n['saldo'];
        $_SESSION['sampah'] = $n['sampah'];
        echo "
        <script>
            alert('Selamat Anda berhasil login!');
            document.location.href ='nasabah.php';
        </script>
        ";
        exit();
    } else {
        echo "
        <script>
            alert('Maaf username dan password tidak valid!');
            document.location.href ='login.php';
        </script>
        ";
        exit();
    }
} else {
    header('location:login.php');
    exit();
}
?>