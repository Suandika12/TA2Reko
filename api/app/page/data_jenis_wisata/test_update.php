<?php
require_once('../../../include/all_include.php');

$id_jenis_wisata = $_POST["id_jenis_wisata"];
$nilai = $_POST["nilai"];

if (isset($id_jenis_wisata) && isset($nilai)) {
    $sql = "UPDATE data_jenis_wisata SET nilai=? WHERE id_jenis_wisata=?";

    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nilai, $id_jenis_wisata]);
    $resp = [];
    $resp["status"] = "success";
    echo (json_encode($resp));
}
