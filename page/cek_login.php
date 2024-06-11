<?php
session_start();
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Query untuk memeriksa user dan password di tabel nasabah
    $query_nasabah = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin='$user' AND password='$pass'");
    $row_nasabah = mysqli_fetch_assoc($query_nasabah);

    // Query untuk memeriksa user dan password di tabel admin
    $query_admin = mysqli_query($conn, "SELECT * FROM admin WHERE nia='$user' AND password='$pass'");
    $row_admin = mysqli_fetch_assoc($query_admin);

    if ($row_nasabah) {
        // Set session untuk nasabah
        $_SESSION['user_n'] = $row_nasabah['nin'];
        $_SESSION['user_type'] = 'nasabah';

        // Redirect ke halaman nasabah
        header("Location: nasabah.php");
        exit();
    } elseif ($row_admin) {
        // Set session untuk admin
        $_SESSION['user_n'] = $row_admin['nia'];
        $_SESSION['user_type'] = 'admin';

        // Redirect ke halaman admin
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Nomor induk atau password salah'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Metode tidak diizinkan'); window.location='login.php';</script>";
}
?>
