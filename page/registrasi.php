<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="http://localhost/Eco-Cash/asset/internal/css/style_register1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway:700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://localhost/Eco-Cash/asset/internal/img/img-local/favicon.ico">
</head>

<body>
    <div class="loginBox">
        <h1>DAFTAR DISINI</h1>
        <form action="cek_registrasi.php" method="post">
            <div class="inputBox">
                <input type="text" name="nin" autocomplete="off" placeholder="Masukan nomor induk" required>
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="text" name="nama" autocomplete="off" placeholder="Masukan nama" required>
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="text" name="rt" autocomplete="off" placeholder="Masukan RT" required>
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="text" name="alamat" autocomplete="off" placeholder="Masukan alamat" required>
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="tel" name="telepon" autocomplete="off" placeholder="Masukan telepon" required>
                <span><i class="fa fa-phone" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="email" name="email" autocomplete="off" placeholder="Masukan email" required>
                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="password" name="password" autocomplete="off" placeholder="Masukan password" required>
                <span><i class="fa fa-lock" aria-hidden="true"></i></span>
            </div>
            <input type="submit" name="register" value="Register">
        </form>
    </div>
</body>

</html>

</html>
