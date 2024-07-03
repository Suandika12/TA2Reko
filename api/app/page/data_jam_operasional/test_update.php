<?php
require_once('../../../include/all_include.php');

$id_jam_operasional = $_POST["id_jam_operasional"];
$nilai = $_POST["nilai"];

if (isset($id_jam_operasional) && isset($nilai)) {
    $sql = "UPDATE data_jam_operasional SET nilai=? WHERE id_jam_operasional=?";

    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nilai, $id_jam_operasional]);
    $resp = [];
    $resp["status"] = "success";
    echo (json_encode($resp));
}
