<?php
include 'E:/xampp/htdocs/Eco-Cash/system/config/koneksi.php';

session_start();
$response = array('success' => false, 'message' => 'Gagal menarik tunai');

if (isset($_POST['user_n']) && isset($_POST['jumlah_tarik'])) {
    $user_n = $_POST['user_n'];
    $jumlah_tarik = floatval($_POST['jumlah_tarik']);

    // Fetch current balance
    $querySaldo = mysqli_query($conn, "SELECT SUM(total) as saldo FROM setor WHERE nin='$user_n'");
    $rowSaldo = mysqli_fetch_assoc($querySaldo);
    $saldoSaatIni = $rowSaldo['saldo'] ?? 0;

    if ($jumlah_tarik > 0 && $jumlah_tarik <= $saldoSaatIni) {
        // Insert into tarik_tunai table
        $queryInsert = mysqli_query($conn, "INSERT INTO tarik_tunai (nin, jumlah, tanggal_tarik) VALUES ('$user_n', '$jumlah_tarik', NOW())");

        if ($queryInsert) {
            // Reduce saldo from setor table
            $remaining = $jumlah_tarik;
            $querySetor = mysqli_query($conn, "SELECT * FROM setor WHERE nin='$user_n' ORDER BY id_setor ASC");

            while ($rowSetor = mysqli_fetch_assoc($querySetor)) {
                $id_setor = $rowSetor['id_setor'];
                $total = $rowSetor['total'];

                if ($remaining <= 0) {
                    break;
                }

                if ($total >= $remaining) {
                    $newTotal = $total - $remaining;
                    mysqli_query($conn, "UPDATE setor SET total = '$newTotal' WHERE id_setor='$id_setor'");
                    $remaining = 0;
                } else {
                    mysqli_query($conn, "UPDATE setor SET total = 0 WHERE id_setor='$id_setor'");
                    $remaining -= $total;
                }
            }

            // Insert into tarik table for history
            $queryTarik = mysqli_query($conn, "INSERT INTO tarik (nin, jumlah_tarik, saldo, tanggal_tarik, nia) VALUES ('$user_n', '$jumlah_tarik', '$saldoSaatIni', NOW(), 'some_nia_value')");

            if ($queryTarik) {
                $response['success'] = true;
                $response['message'] = 'Penarikan tunai berhasil!';
            } else {
                $response['message'] = 'Gagal menyimpan histori penarikan.';
            }
        } else {
            $response['message'] = 'Gagal menyimpan data penarikan.';
        }
    } else {
        $response['message'] = 'Jumlah tarik tidak valid atau melebihi saldo saat ini.';
    }
}

echo json_encode($response);
?>
