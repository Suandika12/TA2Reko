<?php 
require_once('../../../include/all_include.php');

$id_wilayah=isset($_POST["id_wilayah"]) ? $_POST["id_wilayah"]:"";
$wilayah=isset($_POST["wilayah"]) ? $_POST["wilayah"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$query=mysql_query("insert into data_wilayah values (
'$id_wilayah'
,'$wilayah'
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
