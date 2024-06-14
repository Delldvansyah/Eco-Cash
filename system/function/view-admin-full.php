<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Administrator</title>
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
    <h2 style="font-size: 30px; color: #262626;">Data Administrator</h2>
    <br>
    <table id="example" class="display" cellspacing="0" width="100%" border="0">
        <thead>
        <tr>
            <th>No</th>
            <th>NIA</th>
            <th>Nama Admin</th>
            <th>Nomor Telepon</th>
            <th>E-mail</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>No</th>
            <th>NIA</th>
            <th>Nama Admin</th>
            <th>Nomor Telepon</th>
            <th>E-mail</th>
            <th>Level</th>
            <th>Aksi</th>       
        </tr>   
        </tfoot>
        <tbody>
        <?php
            include 'config.php';  // Tambahkan file koneksi database Anda

            $no = 0;
            $query = mysqli_query($conn, "SELECT * FROM admin ORDER BY nia ASC");
            while ($row = mysqli_fetch_assoc($query)) {
                $no++;
        ?>
        <tr align="center">
            <td><?php echo $no; ?></td>
            <td><?php echo $row['nia']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telepon']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['level']; ?></td>
            <td>
                <a href="admin.php?page=edit-admin-id&id=<?php echo $row['nia']; ?>">
                <button>Edit</button>
                </a>
                <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="http://localhost/Eco-Cash/system/function/delete-admin.php?id=<?php echo $row['nia']; ?>">
                <button>Hapus</button>
                </a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
    <a href="admin.php?page=tambah-data-admin">
        <button>Tambah</button>
    </a>
    <a target="_blank" href="http://localhost/Eco-Cash/system/function/excel-admin.php">
        <button>Excel</button>
    </a>
    <a target="_blank" href="http://localhost/Eco-Cash/system/function/print-admin.php">
        <button>Cetak</button>
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
