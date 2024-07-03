<?php 
require_once('../../../include/all_include.php');

$id_jenis_wisata=isset($_POST["id_jenis_wisata"]) ? $_POST["id_jenis_wisata"]:"";
$jenis_wisata=isset($_POST["jenis_wisata"]) ? $_POST["jenis_wisata"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$query=mysql_query("insert into data_jenis_wisata values (
'$id_jenis_wisata'
,'$jenis_wisata'
,'$nilai'

)");

$resp = [];
if($query){
	$resp["status"]="success";
}
else
{
	$resp["status"]="gagal";
}

echo (json_encode($resp)) 
?>
