<?php
require_once('../../../include/all_include.php');

$id_rating = $_POST["id_rating"];
$nilai = $_POST["nilai"];

if (isset($id_rating) && isset($nilai)) {
    $sql = "UPDATE data_rating SET nilai=? WHERE id_rating=?";

    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nilai, $id_rating]);
    $resp = [];
    $resp["status"] = "success";
    echo (json_encode($resp));
}
