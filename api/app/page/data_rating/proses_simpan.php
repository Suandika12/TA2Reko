<?php 
require_once('../../../include/all_include.php');

$id_rating=isset($_POST["id_rating"]) ? $_POST["id_rating"]:"";
$rating=isset($_POST["rating"]) ? $_POST["rating"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$query=mysql_query("insert into data_rating values (
'$id_rating'
,'$rating'
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
