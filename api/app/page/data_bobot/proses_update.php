<?php 
require_once('../../../include/all_include.php');

$id_bobot=isset($_POST["id_bobot"]) ? $_POST["id_bobot"]:"";
$jenis_wisata=isset($_POST["jenis_wisata"]) ? $_POST["jenis_wisata"]:"";
$wilayah=isset($_POST["wilayah"]) ? $_POST["wilayah"]:"";
$rating=isset($_POST["rating"]) ? $_POST["rating"]:"";
$harga_tiket=isset($_POST["harga_tiket"]) ? $_POST["harga_tiket"]:"";
$hari_operasional=isset($_POST["hari_operasional"]) ? $_POST["hari_operasional"]:"";
$jam_operasional=isset($_POST["jam_operasional"]) ? $_POST["jam_operasional"]:"";

$sql = "UPDATE data_bobot SET 
jenis_wisata=?,
wilayah=?,
rating=?,
harga_tiket=?,
hari_operasional=?,
jam_operasional=?,

WHERE id_bobot=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$jenis_wisata,
$wilayah,
$rating,
$harga_tiket,
$hari_operasional,
$jam_operasional,

$id_bobot]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
