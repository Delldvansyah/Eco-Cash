<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Setor Sampah</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/Eco-Cash/datatables/css/jquery.dataTables.css">
    <style>
        label {
            font-family: Montserrat;    
            font-size: 18px;
            display: block;
            color: #262627;
        }
    </style>
</head>
<body>
    <h2 style="font-size: 30px; color: #262626;">Transaksi Setor Sampah</h2>
    <br>
    <table id="example" class="display" cellspacing="0" width="100%" border="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>NIN</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
                <th>Harga</th>
                <th>Total</th>
                <th>NIA</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>NIN</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
                <th>Harga</th>
                <th>Total</th>
                <th>NIA</th>
                <th>Aksi</th>       
            </tr>   
        </tfoot>
        <tbody>
        <?php
            include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';
            $query = mysqli_query($conn, "SELECT * FROM setor ORDER BY id_setor ASC");
            while($row = mysqli_fetch_assoc($query)) {
        ?>
            <tr align="center">
                <td><?php echo $row['id_setor'] ?></td>
                <td><?php echo $row['tanggal_setor'] ?></td>
                <td><?php echo $row['nin'] ?></td>
                <td><?php echo $row['jenis_sampah'] ?></td>
                <td><?php echo number_format($row['berat'])." Kg"  ?></td>
                <td><?php echo "Rp. ".number_format($row['harga'], 2, ",", ".")  ?></td>
                <td><?php echo "Rp. ".number_format($row['total'], 2, ",", ".")  ?></td>
                <td><?php echo $row['nia'] ?></td>
                <td>
                    <a href="admin.php?page=edit-setor&id=<?php echo $row['id_setor'] ?>"><button><i class="fa fa-pencil"></i>edit</button></a>
                    <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="http://localhost/Eco-Cash/system/function/delete-setor.php?id=<?php echo $row['id_setor'] ?>"><button><i class="fa fa-trash-o"></i>hapus</button></a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
</html>
