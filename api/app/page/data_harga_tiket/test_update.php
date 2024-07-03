<?php
require_once('../../../include/all_include.php');

$id_harga_tiket = $_POST["id_harga_tiket"];
$nilai = $_POST["nilai"];

if (isset($id_harga_tiket) && isset($nilai)) {
    $sql = "UPDATE data_harga_tiket SET nilai=? WHERE id_harga_tiket=?";

    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nilai, $id_harga_tiket]);
    $resp = [];
    $resp["status"] = "success";
    echo (json_encode($resp));
}
