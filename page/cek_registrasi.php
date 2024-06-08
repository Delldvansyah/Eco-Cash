<?php
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nin = mysqli_real_escape_string($conn, $_POST['nin']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $rt = mysqli_real_escape_string($conn, $_POST['rt']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek apakah NIN sudah ada di database
    $check_nin_query = "SELECT nin FROM nasabah WHERE nin='$nin'";
    $check_nin_result = mysqli_query($conn, $check_nin_query);

    if (mysqli_num_rows($check_nin_result) > 0) {
        echo "
        <script>
            alert('NIN sudah terdaftar!');
            document.location.href ='registrasi.php';
        </script>
        ";
    } else {
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
    }

    mysqli_close($conn);
}
?>
