<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Penarikan Saldo</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/Eco-Cash/datatables/css/jquery.dataTables.css">
	<style>
		label{
			font-family: Montserrat;    
			font-size: 18px;
			display: block;
			color: #262627;
		}
	</style>
</head>
<body>
	<h2 style="font-size: 30px; color: #262626;">Penarikan Saldo</h2>
	<br>
	<table id="example" class="display" cellspacing="0" width="100%" border="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>NIN</th>
            <th>Saldo</th>
            <th>Jumlah Tarik</th>
            <th>NIA</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>NIN</th>
            <th>Saldo</th>
            <th>Jumlah Tarik</th>
            <th>NIA</th>
            <th>Aksi</th>       
        </tr>   
        </tfoot>
        <tbody>
        <?php
            include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';
            $query = mysqli_query($conn, "SELECT * FROM tarik ORDER BY id_tarik ASC");
            while($row = mysqli_fetch_assoc($query)){
        ?>
        <tr align="center">
            <td><?php echo $row['id_tarik'] ?></td>
            <td><?php echo $row['tanggal_tarik'] ?></td>
            <td><?php echo $row['nin'] ?></td>
            <td><?php echo "Rp. ".number_format($row['saldo'], 2, ",", ".")  ?></td>
            <td><?php echo "Rp. ".number_format($row['jumlah_tarik'], 2, ",", ".")  ?></td>
            <td><?php echo $row['nia'] ?></td>
            <td>
                <a href="admin.php?page=edit-tarik&id=<?php echo $row['id_tarik']; ?>">
                <button><i class="fa fa-pencil"></i>edit</button> 
                </a>
                <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="http://localhost/Eco-Cash/system/function/delete-tarik.php?id=<?php echo $row['id_tarik']; ?>">
                <button><i class="fa fa-trash-o"></i>hapus</button>
                </a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
    <a href="admin.php?page=tambah-data-tarik">
    <button><i class="fa fa-plus" aria-hidden="true"></i>Tambah</button>
    </a>
    <a target="_blank" href="http://localhost/Eco-Cash/system/function/excel-tarik.php">
    <button><i class="fa fa-print" aria-hidden="true"></i>Excel</button>
    </a>
    <a target="_blank" href="http://localhost/Eco-Cash/system/function/print-tarik.php">
    <button><i class="fa fa-print" aria-hidden="true"></i>Cetak</button>
    </a>
    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.js"></script>
    <script type="text/javascript" src="http://localhost/Eco-Cash/datatables/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
</body>
</html>
