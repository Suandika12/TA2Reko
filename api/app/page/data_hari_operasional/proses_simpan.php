<?php 
require_once('../../../include/all_include.php');

$id_hari_operasional=isset($_POST["id_hari_operasional"]) ? $_POST["id_hari_operasional"]:"";
$hari_operasional=isset($_POST["hari_operasional"]) ? $_POST["hari_operasional"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$query=mysql_query("insert into data_hari_operasional values (
'$id_hari_operasional'
,'$hari_operasional'
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
