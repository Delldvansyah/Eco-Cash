<?php
session_start();
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Query untuk memeriksa admin
    $query_admin = mysqli_query($conn, "SELECT * FROM admin WHERE nia='$user' AND password='$pass'");
    $data_admin = mysqli_fetch_assoc($query_admin);

    // Query untuk memeriksa nasabah
    $query_nasabah = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin='$user' AND password='$pass'");
    $data_nasabah = mysqli_fetch_assoc($query_nasabah);

    if ($data_admin) {
        // Set session admin
        $_SESSION['level'] = $data_admin['level'];
        $_SESSION['nama'] = $data_admin['nama'];
        $_SESSION['email'] = $data_admin['email'];
        $_SESSION['telepon'] = $data_admin['telepon'];
        $_SESSION['nia'] = $data_admin['nia'];

        // Redirect ke halaman admin
        header("Location: admin.php");
        exit();
    } elseif ($data_nasabah) {
        // Set session nasabah
        $_SESSION['user_n'] = $data_nasabah['nama'];
        $_SESSION['email_n'] = $data_nasabah['email'];
        $_SESSION['pass_n'] = $data_nasabah['password'];
        $_SESSION['telepon_n'] = $data_nasabah['telepon'];
        $_SESSION['nin'] = $data_nasabah['nin'];
        $_SESSION['rt'] = $data_nasabah['rt'];
        $_SESSION['alamat'] = $data_nasabah['alamat'];
        $_SESSION['saldo'] = $data_nasabah['saldo'];
        $_SESSION['sampah'] = $data_nasabah['sampah'];

        // Redirect ke halaman nasabah
        header("Location: nasabah.php");
        exit();
    } else {
        echo "<script>alert('Nomor induk atau password salah'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Metode tidak diizinkan'); window.location='login.php';</script>";
}
?>