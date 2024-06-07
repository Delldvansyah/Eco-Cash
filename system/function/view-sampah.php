<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
    <h2 style="font-size: 30px; color: #262626;">Data Sampah</h2>
    <br>
    <table id="example" class="display" cellspacing="0" width="100%" border="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Sampah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Jenis Sampah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>   
        </tfoot>
        <tbody>
        <?php
            // Pastikan untuk menyertakan file koneksi database Anda di sini
            include 'http://localhost/Eco-Cash/system/config/koneksi.php'; // pastikan nama file koneksi benar

            $no = 0;
            $query = mysqli_query($conn, "SELECT * FROM sampah ORDER BY jenis_sampah ASC");
            while ($row = mysqli_fetch_assoc($query)) {
                $no++;
        ?>
            <tr align="center">
                <td><?php echo htmlspecialchars($no, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_sampah'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['satuan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo "Rp. " . number_format($row['harga'], 2, ",", "."); ?></td>
                <td><img src="http://localhost/Eco-Cash/asset/internal/img/uploads/<?php echo htmlspecialchars($row['gambar'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" width="100px" height="50px" alt="Gambar Sampah"></td>
                <td><?php echo htmlspecialchars($row['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <a href="admin.php?page=edit-sampah&id=<?php echo htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <button><i class="fa fa-pencil"></i>edit</button> 
                    </a>
                    <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="http://localhost/Eco-Cash/system/function/delete-sampah.php?id=<?php echo htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        <button><i class="fa fa-trash-o"></i>hapus</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <br><br>
    
    <a href="admin.php?page=tambah-data-sampah">
        <button><i class="fa fa-plus" aria-hidden="true"></i>Tambah</button>
    </a>

    <a target="_blank" href="http://localhost/Eco-Cash/system/function/excel-sampah.php">
        <button><i class="fa fa-print" aria-hidden="true"></i>Excel</button>
    </a>

    <a target="_blank" href="http://localhost/Eco-Cash/system/function/print-sampah.php">
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
