<?php
require_once("../config/koneksi.php");  // Menggunakan path relatif
$id = $_GET['id'];
$query = "DELETE FROM tarik WHERE id_tarik = '$id'";
$queryact = mysqli_query($conn, $query);

if($queryact) {
    echo "<meta http-equiv='refresh' content='0; url=http://localhost/ecocash/page/admin.php?page=data-tarik'>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
