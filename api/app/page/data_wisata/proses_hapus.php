<?php 
require_once('../../../include/all_include.php');
$id_wisata=isset($_POST["proses"]) ? $_POST["proses"]:"";
$sql = "DELETE FROM data_wisata WHERE id_wisata=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_wisata]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
