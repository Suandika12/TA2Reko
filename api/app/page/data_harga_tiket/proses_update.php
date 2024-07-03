<?php 
require_once('../../../include/all_include.php');

$id_harga_tiket=isset($_POST["id_harga_tiket"]) ? $_POST["id_harga_tiket"]:"";
$harga_tiket=isset($_POST["harga_tiket"]) ? $_POST["harga_tiket"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";

$sql = "UPDATE data_harga_tiket SET 
harga_tiket=?,
nilai=?,

WHERE id_harga_tiket=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$harga_tiket,
$nilai,

$id_harga_tiket]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
