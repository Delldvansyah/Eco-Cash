<?php
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Hitung total saldo dari histori setor
    $saldo_query = mysqli_query($conn, "SELECT SUM(total) AS saldo FROM setor WHERE nin='$user_id'");
    $saldo_row = mysqli_fetch_assoc($saldo_query);
    $saldo = $saldo_row['saldo'];

    if ($saldo <= 0) {
        echo json_encode(['success' => false, 'message' => 'Saldo tidak mencukupi']);
        exit();
    }

    // Jumlah tarik tunai (misalnya kita ambil semua saldo untuk penarikan tunai)
    $jumlah_tarik = $saldo;
    $tanggal_tarik = date('Y-m-d');

    // Kurangi saldo dari histori setor
    $update_setor_query = "UPDATE setor SET total = 0 WHERE nin='$user_id'";
    if (!mysqli_query($conn, $update_setor_query)) {
        echo json_encode(['success' => false, 'message' => 'Gagal mengurangi saldo dari histori setor']);
        exit();
    }

    // Masukkan data ke histori tarik
    $query = "INSERT INTO tarik (nin, saldo, jumlah_tarik, tanggal_tarik, nia) VALUES ('$user_id', '$saldo', '$jumlah_tarik', '$tanggal_tarik', 'NIA')";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Penarikan tunai berhasil']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Penarikan tunai gagal']);
    }
}
?>