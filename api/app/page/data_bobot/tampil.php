<?php 
require_once('../../../include/all_include.php');
$resp = [];
$resp["status"]="success";
$resp["result"] = array();

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi']))
{
	$berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
	$isi =  mysql_real_escape_string($_POST['isi']);
	$limit =  mysql_real_escape_string($_POST['limit']);
	$hal =  mysql_real_escape_string($_POST['hal']);
	if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai']))
	{
		$dari =  mysql_real_escape_string($_POST['dari']);
		$sampai =  mysql_real_escape_string($_POST['sampai']);
		$query="SELECT * FROM data_bobot where $berdasarkan like '%$isi%'";
	}
	else
	{
		$query="SELECT * FROM data_bobot where $berdasarkan like '%$isi%'";
	}
}
else
{
	$query = "select * from data_bobot";
}

$proses = mysql_query($query);	
  while($data = mysql_fetch_array($proses))
  {
	
	$id_bobot = $data["id_bobot"];	
    $hasil['id_bobot'] = $id_bobot;
	$hasil['jenis_wisata'] = $data["jenis_wisata"];
	$hasil['wilayah'] = $data["wilayah"];
	$hasil['rating'] = $data["rating"];
	$hasil['harga_tiket'] = $data["harga_tiket"];
	$hasil['hari_operasional'] = $data["hari_operasional"];
	$hasil['jam_operasional'] = $data["jam_operasional"];

    array_push($resp["result"], $hasil);
  }
  
json_print($resp);
?>
