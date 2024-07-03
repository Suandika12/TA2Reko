<?php 
require_once('../../../include/all_include.php');

$id_rating=isset($_POST["id_rating"]) ? $_POST["id_rating"]:"";
$rating=isset($_POST["rating"]) ? $_POST["rating"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$sql = "UPDATE data_rating SET 
rating=?,
nilai=?,

WHERE id_rating=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$rating,
$nilai,

$id_rating]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
