<?php
require_once('../../../include/all_include.php');

$id_wilayah = $_POST["id_wilayah"];
$nilai = $_POST["nilai"];

if (isset($id_wilayah) && isset($nilai)) {
    $sql = "UPDATE data_wilayah SET nilai=? WHERE id_wilayah=?";

    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nilai, $id_wilayah]);
    $resp = [];
    $resp["status"] = "success";
    echo (json_encode($resp));
}
