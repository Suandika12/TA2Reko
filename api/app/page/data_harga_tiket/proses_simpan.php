<?php 
require_once('../../../include/all_include.php');

$id_harga_tiket=isset($_POST["id_harga_tiket"]) ? $_POST["id_harga_tiket"]:"";
$harga_tiket=isset($_POST["harga_tiket"]) ? $_POST["harga_tiket"]:"";
$nilai=isset($_POST["nilai"]) ? $_POST["nilai"]:"";


$query=mysql_query("insert into data_harga_tiket values (
'$id_harga_tiket'
,'$harga_tiket'
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
