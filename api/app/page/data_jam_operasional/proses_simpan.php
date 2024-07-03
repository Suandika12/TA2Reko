<?php 
require_once('../../../include/all_include.php');

$id_jam_operasional=isset($_POST["id_jam_operasional"]) ? $_POST["id_jam_operasional"]:"";
$jam_operasional=isset($_POST["jam_operasional"]) ? $_POST["jam_operasional"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$query=mysql_query("insert into data_jam_operasional values (
'$id_jam_operasional'
,'$jam_operasional'
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
