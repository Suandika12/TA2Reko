<?php 
require_once('../../../include/all_include.php');

$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$nama_lengkap=isset($_POST["nama_lengkap"]) ? $_POST["nama_lengkap"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$sql = "UPDATE data_admin SET 
nama_lengkap=?,
username=?,
password=?,

WHERE id_admin=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama_lengkap,
$username,
$password,

$id_admin]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
