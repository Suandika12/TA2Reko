<?php
require_once('../../../include/all_include.php');
$resp = [];
$resp["status"] = "success";
$resp["result"] = array();

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi'])) {
	$berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
	$isi =  mysql_real_escape_string($_POST['isi']);
	$limit =  mysql_real_escape_string($_POST['limit']);
	$hal =  mysql_real_escape_string($_POST['hal']);
	if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai'])) {
		$dari =  mysql_real_escape_string($_POST['dari']);
		$sampai =  mysql_real_escape_string($_POST['sampai']);
		$query = "SELECT * FROM data_wisata where $berdasarkan like '%$isi%'";
	} else {
		$query = "SELECT * FROM data_wisata where $berdasarkan like '%$isi%'";
	}
} else {
	$query = "select * from data_wisata";
}

$proses = mysql_query($query);
while ($data = mysql_fetch_array($proses)) {

	$id_wisata = $data["id_wisata"];
	$hasil['id_wisata'] = $id_wisata;
	$hasil['nama_wisata'] = $data["nama_wisata"];
	$hasil['foto'] = $data["foto"];
	$hasil['deskripsi'] = $data["deskripsi"];
	$hasil['koordinat'] = $data["koordinat"];
	$hasil['id_jenis_wisata'] = $data["id_jenis_wisata"];
	$hasil['jenis_wisata'] = baca_database("", "jenis_wisata", "SELECT * FROM data_jenis_wisata WHERE id_jenis_wisata='$data[id_jenis_wisata]'");
	$hasil['id_wilayah'] = $data["id_wilayah"];
	$hasil['wilayah'] = baca_database("", "wilayah", "SELECT * FROM data_wilayah WHERE id_wilayah='$data[id_wilayah]'");
	$hasil['id_rating'] = $data["id_rating"];
	$hasil['rating'] = baca_database("", "rating", "SELECT * FROM data_rating WHERE id_rating='$data[id_rating]'");
	$hasil['id_harga_tiket'] = $data["id_harga_tiket"];
	$hasil['harga_tiket'] = baca_database("", "harga_tiket", "SELECT * FROM data_harga_tiket WHERE id_harga_tiket='$data[id_harga_tiket]'");
	$hasil['id_hari_operasional'] = $data["id_hari_operasional"];
	$hasil['hari_operasional'] = baca_database("", "hari_operasional", "SELECT * FROM data_hari_operasional WHERE id_hari_operasional='$data[id_hari_operasional]'");
	$hasil['id_jam_operasional'] = $data["id_jam_operasional"];
	$hasil['jam_operasional'] = baca_database("", "jam_operasional", "SELECT * FROM data_jam_operasional WHERE id_jam_operasional = '$data[id_jam_operasional]'");

	array_push($resp["result"], $hasil);	
}

json_print($resp);
