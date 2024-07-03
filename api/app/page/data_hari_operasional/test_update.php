<?php
require_once('../../../include/all_include.php');

$id_hari_operasional = $_POST["id_hari_operasional"];
$nilai = $_POST["nilai"];

if (isset($id_hari_operasional) && isset($nilai)) {
    $sql = "UPDATE data_hari_operasional SET nilai=? WHERE id_hari_operasional=?";

    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nilai, $id_hari_operasional]);
    $resp = [];
    $resp["status"] = "success";
    echo (json_encode($resp));
}
