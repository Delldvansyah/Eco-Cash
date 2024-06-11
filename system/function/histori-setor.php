<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Histori Setor Nasabah</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/Eco-Cash/datatables/css/jquery.dataTables.css">
    <style>
        label {
            font-family: Montserrat;
            font-size: 18px;
            display: block;
            color: #262626;
        }
        button {
            height: 27px;
            width: 100px;
            background: #8cd91a;
            border-radius: 5px;
            color: #fff;
            font-family: Montserrat;
        }
    </style>
</head>
<body>
    <h2 style="font-size: 30px; color: #262626;">Histori Setor Nasabah</h2>
    <br>
    <?php
    include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

    if (!isset($_SESSION['user_n'])) {
        header("Location: login.php");
        exit();
    }

    // Fetch current balance
    $querySaldo = mysqli_query($conn, "SELECT SUM(total) as saldo FROM setor WHERE nin='" . $_SESSION['user_n'] . "'");
    $rowSaldo = mysqli_fetch_assoc($querySaldo);
    $saldoSaatIni = $rowSaldo['saldo'] ?? 0;
    ?>

    <label>Saldo Saat Ini: Rp. <?php echo number_format($saldoSaatIni, 2, ",", "."); ?></label>
    <br>
    <table id="example" class="display" cellspacing="0" width="100%" border="0">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jenis Sampah</th>
            <th>Berat</th>
            <th>Harga</th>
            <th>Total</th>
            <th>NIA</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jenis Sampah</th>
            <th>Berat</th>
            <th>Harga</th>
            <th>Total</th>
            <th>NIA</th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        $no = 0;
        $query = mysqli_query($conn, "SELECT * FROM setor WHERE nin='" . $_SESSION['user_n'] . "' ORDER BY id_setor DESC");
        while ($row = mysqli_fetch_array($query)) {
            $no++;
        ?>
        <tr align="center">
            <td><?php echo $no ?></td>
            <td><?php echo $row['tanggal_setor'] ?></td>
            <td><?php echo $row['jenis_sampah'] ?></td>
            <td><?php echo number_format($row['berat']) . " Kg" ?></td>
            <td><?php echo "Rp. " . number_format($row['harga'], 2, ",", ".") ?></td>
            <td><?php echo "Rp. " . number_format($row['total'], 2, ",", ".") ?></td>
            <td><?php echo $row['nia'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
    <br>

    <a target="_blank" href="http://localhost/Eco-Cash/system/function/print-histori-setor.php">
        <button><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
    </a>
    <button onclick="tarikTunai()">Tarik Tunai</button>

    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function tarikTunai() {
            var userId = <?php echo json_encode($_SESSION['user_n']); ?>;
            var saldoSaatIni = <?php echo json_encode($saldoSaatIni); ?>;
            var jumlahTarik = prompt('Saldo saat ini: Rp. ' + saldoSaatIni.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) + '\nMasukkan jumlah yang ingin ditarik:');
            
            if (jumlahTarik !== null && jumlahTarik > 0 && jumlahTarik <= saldoSaatIni) {
                if (confirm('Apakah Anda yakin ingin menarik tunai sebesar Rp. ' + parseFloat(jumlahTarik).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) + '?')) {
                    $.post('http://localhost/Eco-Cash/system/function/tarik-tunai.php', { user_n: userId, jumlah_tarik: jumlahTarik }, function(response) {
                        alert(response.message);
                        if (response.success) {
                            location.reload();
                        }
                    }, 'json');
                }
            } else {
                alert('Jumlah tarik tidak valid atau melebihi saldo saat ini.');
            }
        }
    </script>
</body>
</html>
