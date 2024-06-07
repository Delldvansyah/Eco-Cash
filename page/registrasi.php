<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="E:/xampp/htdocs/Eco-Cash/asset/internal/css/style_1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway:700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="E:/xampp/htdocs/Eco-Cash/asset/internal/img/img-local/favicon.ico">
</head>

<body>
    <div class="loginBox">
        <h1>DAFTAR DISINI</h1>
        <form action="register.php" method="post">
            <div class="inputBox">
                <input type="text" name="user" autocomplete="off" placeholder="Masukan nomor induk" required>
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="email" name="email" autocomplete="off" placeholder="Masukan email" required>
                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
            </div>
            <div class="inputBox">
                <input type="password" name="pass" autocomplete="off" placeholder="Masukan password" required>
                <span><i class="fa fa-lock" aria-hidden="true"></i></span>
            </div>
            <input type="submit" name="register" value="Register">
        </form>
    </div>
</body>

</html>
