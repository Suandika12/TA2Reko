<?php 
require_once('../../../include/all_include.php');

$id_hari_operasional=isset($_POST["id_hari_operasional"]) ? $_POST["id_hari_operasional"]:"";
$hari_operasional=isset($_POST["hari_operasional"]) ? $_POST["hari_operasional"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";

$sql = "UPDATE data_hari_operasional SET 
hari_operasional=?,
nilai=?,

WHERE id_hari_operasional=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$hari_operasional,
$nilai,

$id_hari_operasional]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
