<?php 
require_once('../../../include/all_include.php');

$id_jenis_wisata=isset($_POST["id_jenis_wisata"]) ? $_POST["id_jenis_wisata"]:"";
$jenis_wisata=isset($_POST["jenis_wisata"]) ? $_POST["jenis_wisata"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$sql = "UPDATE data_jenis_wisata SET 
jenis_wisata=?,
nilai=?,

WHERE id_jenis_wisata=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$jenis_wisata,
$nilai,

$id_jenis_wisata]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
