<?php
require_once('../../../include/all_include.php');


function upload_disini($namafile)
{
	$time = time();
	$acak = rand(10000, 99999);
	$foto = $time . "-" . $acak . "-" . $_FILES[$namafile]['name'];
	$tmp_file = $_FILES[$namafile]['tmp_name'];
	$path = "../../../../admin/upload/" . $foto;
	global $ekstensi_dilarang;
	$nama = $_FILES[$namafile]['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	if (in_array($ekstensi, $ekstensi_dilarang) === false) {
		move_uploaded_file($tmp_file, $path);
		return $foto;
	} else {
		http_response_code(404);
		echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
		die();
	}
}

$id_wisata = isset($_POST["id_wisata"]) ? $_POST["id_wisata"] : "";
$nama_wisata = isset($_POST["nama_wisata"]) ? $_POST["nama_wisata"] : "";
// $foto = isset($_POST["foto"]) ? $_POST["foto"] : "";

$foto = upload_disini("file_foto");

$deskripsi = isset($_POST["deskripsi"]) ? $_POST["deskripsi"] : "";
$koordinat = isset($_POST["koordinat"]) ? $_POST["koordinat"] : "";
$id_jenis_wisata = isset($_POST["id_jenis_wisata"]) ? $_POST["id_jenis_wisata"] : "";
$id_wilayah = isset($_POST["id_wilayah"]) ? $_POST["id_wilayah"] : "";
$id_rating = isset($_POST["id_rating"]) ? $_POST["id_rating"] : "";
$id_harga_tiket = isset($_POST["id_harga_tiket"]) ? $_POST["id_harga_tiket"] : "";
$id_hari_operasional = isset($_POST["id_hari_operasional"]) ? $_POST["id_hari_operasional"] : "";
$id_jam_operasional = isset($_POST["id_jam_operasional"]) ? $_POST["id_jam_operasional"] : "";


$query = mysql_query("insert into data_wisata values (
'$id_wisata'
,'$nama_wisata'
,'$foto'
,'$deskripsi'
,'$koordinat'
,'$id_jenis_wisata'
,'$id_wilayah'
,'$id_rating'
,'$id_harga_tiket'
,'$id_hari_operasional'
,'$id_jam_operasional'

)");

$resp = [];
if ($query) {
	$resp["status"] = "success";
} else {
	$resp["status"] = "gagal";
}

echo (json_encode($resp))
?>
