histori-tarik.php :
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Histori Tarik Nasabah</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/Eco-Cash/datatables/css/jquery.dataTables.css">
    <style>
        label {
            font-family: Montserrat;
            font-size: 18px;
            display: block;
            color: #262626;
        }
    </style>
</head>
<body>
    <h2 style="font-size: 30px; color: #262626;">Histori Tarik Nasabah</h2>
    <br>
    <table id="example" class="display" cellspacing="0" width="100%" border="0">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Saldo (Rp)</th>
            <th>Jumlah Tarik</th>
            <th>NIA</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Saldo (Rp)</th>
            <th>Jumlah Tarik</th>
            <th>NIA</th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        session_start();
        include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $no = 0;
        $query = mysqli_query($conn, "SELECT * FROM tarik WHERE nin='" . $_SESSION['user_id'] . "' ORDER BY id_tarik DESC");
        while ($row = mysqli_fetch_array($query)) {
            $no++;
        ?>
        <tr align="center">
            <td><?php echo $no ?></td>
            <td><?php echo $row['tanggal_tarik'] ?></td>
            <td><?php echo "Rp. " . number_format($row['saldo'], 2, ",", ".") ?></td>
            <td><?php echo "Rp. " . number_format($row['jumlah_tarik'], 2, ",", ".") ?></td>
            <td><?php echo $row['nia'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
    <br>

    <a target="_blank" href="http://localhost/Eco-Cash/system/function/print-histori-tarik.php">
        <button><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
    </a>

    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
</html>