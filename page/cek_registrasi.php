<?php
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nin = mysqli_real_escape_string($conn, $_POST['nin']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $rt = mysqli_real_escape_string($conn, $_POST['rt']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_BCRYPT));

    $sql = "INSERT INTO nasabah (nin, nama, rt, alamat, telepon, email, password) VALUES ('$nin', '$nama', '$rt', '$alamat', '$telepon', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "
        <script>
            alert('Registrasi berhasil!');
            document.location.href ='login.php';
        </script>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
