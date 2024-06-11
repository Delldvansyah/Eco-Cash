<?php
 require_once("E:/xampp/htdocs/Eco-cash/system/config/koneksi.php");
 $id = $_GET['id'];
 $query = "DELETE FROM setor WHERE id_setor = '$id'";
 $queryact = mysqli_query($conn, $query);
 echo "<meta http-equiv='refresh'
            content='0; url=http://localhost/Eco-Cash/page/admin.php?page=data-setor'>";
?>
