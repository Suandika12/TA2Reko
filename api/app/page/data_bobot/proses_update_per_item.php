<?php
require_once('../../../include/all_include.php');

$id_bobot = isset($_POST["id_bobot"]) ? $_POST["id_bobot"] : "";

$sql = "UPDATE data_bobot ";

if (isset($_POST["jenis_wisata"]) && $_POST["jenis_wisata"]) {
    $jenis_wisata = $_POST["jenis_wisata"];
    $sql .= "SET jenis_wisata = $jenis_wisata";
}

if (isset($_POST["wilayah"]) && $_POST["wilayah"]) {
    $wilayah = $_POST["wilayah"];
    $sql .= "SET wilayah = $wilayah";
}

if (isset($_POST["rating"]) && $_POST["rating"]) {
    $rating = $_POST["rating"];
    $sql .= "SET rating = $rating";
}

if (isset($_POST["harga_tiket"]) && $_POST["harga_tiket"]) {
    $harga_tiket = $_POST["harga_tiket"];
    $sql .= "SET harga_tiket = $harga_tiket";
}

if (isset($_POST["hari_operasional"]) && $_POST["hari_operasional"]) {
    $hari_operasional = $_POST["hari_operasional"];
    $sql .= "SET hari_operasional = $hari_operasional";
}

if (isset($_POST["jam_operasional"]) && $_POST["jam_operasional"]) {
    $jam_operasional = $_POST["jam_operasional"];
    $sql .= "SET jam_operasional = $jam_operasional";
}

$sql .= " WHERE id_bobot = 'BOB20240223060800825'";

// echo $sql;
// die();

$stmt = $dbh->prepare($sql);
$stmt->execute();
$resp = [];
$resp["status"] = "success";
jsonPrint($resp);

function jsonPrint($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}
