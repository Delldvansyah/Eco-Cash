<?php
 require_once("E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php");
 $id = $_GET['id'];
 $query = "DELETE FROM sampah WHERE jenis_sampah = '$id'";
 $queryact = mysqli_query($conn, $query);
 echo "<meta http-equiv='refresh'
              content='0; url=http://localhost/bsk09/page/admin.php?page=data-sampah'>";
?>