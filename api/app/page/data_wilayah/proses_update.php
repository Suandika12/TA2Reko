<?php 
require_once('../../../include/all_include.php');

$id_wilayah=isset($_POST["id_wilayah"]) ? $_POST["id_wilayah"]:"";
$wilayah=isset($_POST["wilayah"]) ? $_POST["wilayah"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$sql = "UPDATE data_wilayah SET 
wilayah=?,
nilai=?,

WHERE id_wilayah=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$wilayah,
$nilai,

$id_wilayah]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
