<?php
session_start();
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Query untuk memeriksa user dan password
    $query = mysqli_query($conn, "SELECT * FROM nasabah WHERE nin='$user' AND password='$pass'");
    $row = mysqli_fetch_assoc($query);

    if ($row) {
        // Set session user_id
        $_SESSION['user_id'] = $row['nin'];

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
