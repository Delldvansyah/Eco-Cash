<?php
 require_once("http://localhost/Eco-Cash/system/config/koneksi.php");
 $id = $_GET['id'];
 $query = "DELETE FROM admin WHERE nia = '$id'";
 $queryact = mysqli_query($conn, $query);
 echo "<meta http-equiv='refresh'
              content='0; url=http://localhost/ecocash/page/admin.php?page=data-admin-full'>";
?>
