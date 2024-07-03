<?php 
require_once('../../../include/all_include.php');

$id_jam_operasional=isset($_POST["id_jam_operasional"]) ? $_POST["id_jam_operasional"]:"";
$jam_operasional=isset($_POST["jam_operasional"]) ? $_POST["jam_operasional"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$sql = "UPDATE data_jam_operasional SET 
jam_operasional=?,
nilai=?,

WHERE id_jam_operasional=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$jam_operasional,
$nilai,

$id_jam_operasional]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
