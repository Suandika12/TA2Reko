<?php

require_once('../../../include/all_include.php');
include "moora.php";

class Data implements DMoora
{
	private $datas = [];

	private function getData()
	{
		global $dbh;

		$stmt = $dbh->prepare(" SELECT
			data_wisata.*,
			COALESCE((SELECT nilai FROM data_jenis_wisata WHERE id_jenis_wisata = data_wisata.id_jenis_wisata), 0) as nilai_jenis_wisata ,
			COALESCE((SELECT nilai FROM data_wilayah WHERE id_wilayah = data_wisata.id_wilayah), 0) as nilai_wilayah ,
			COALESCE((SELECT nilai FROM data_rating WHERE id_rating = data_wisata.id_rating), 0) as nilai_rating ,
			COALESCE((SELECT nilai FROM data_harga_tiket WHERE id_harga_tiket = data_wisata.id_harga_tiket), 0) as nilai_harga_tiket ,
			COALESCE((SELECT nilai FROM data_hari_operasional WHERE id_hari_operasional = data_wisata.id_hari_operasional), 0) as nilai_hari_operasional ,
			COALESCE((SELECT nilai FROM data_jam_operasional WHERE id_jam_operasional = data_wisata.id_jam_operasional), 0) as nilai_jam_operasional
			FROM data_wisata;
			");

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function execute()
	{
		$this->datas = $this->getData();
	}

	public function getDataWisata()
	{
		return $this->datas;
	}

	public function get()
	{
		$datas = $this->datas;
		$rets = [];

		if ($datas) {
			foreach ($datas as $data) {
				$rets[] = [
					$data['nilai_jenis_wisata'],
					$data['nilai_wilayah'],
					$data['nilai_rating'],
					$data['nilai_harga_tiket'],
					$data['nilai_hari_operasional'],
					$data['nilai_jam_operasional'],
				];
			}
			return $rets;
		} else {
			die("Error, Data wisata tidak ditemukan.");
		}

		return $rets;
	}
}

class Weights implements DMoora
{
	private function getData()
	{
		global $dbh;

		$id_jenis_wisata = xss($_GET['id_jenis_wisata']);
		$id_wilayah = xss($_GET['id_wilayah']);
		$id_rating = xss($_GET['id_rating']);
		$id_harga_tiket = xss($_GET['id_harga_tiket']);
		$id_hari_operasional = xss($_GET['id_hari_operasional']);
		$id_jam_operasional = xss($_GET['id_jam_operasional']);

		var_dump($id_jenis_wisata);
		die();

		$n_jenis_wisata = baca_database("", "nilai", "SELECT COALESCE(nilai, 0) as nilai FROM data_jenis_wisata WHERE id_jenis_wisata = '$id_jenis_wisata'");
		$n_wilayah = baca_database("", "nilai", "SELECT COALESCE(nilai, 0)  as nilai FROM data_wilayah WHERE id_wilayah = '$id_wilayah'");
		$n_rating = baca_database("", "nilai", "SELECT COALESCE(nilai, 0)  as nilai FROM data_rating WHERE id_rating = '$id_rating'");
		$n_harga_tiket = baca_database("", "nilai", "SELECT COALESCE(nilai, 0)  as nilai FROM data_harga_tiket WHERE id_harga_tiket = '$id_harga_tiket'");
		$n_hari_operasional = baca_database("", "nilai", "SELECT COALESCE(nilai, 0)  as nilai FROM data_hari_operasional WHERE id_hari_operasional = '$id_hari_operasional'");
		$n_jam_operasional = baca_database("", "nilai", "SELECT COALESCE(nilai, 0)  as nilai FROM data_jam_operasional WHERE id_jam_operasional = '$id_jam_operasional'");

		$data = [
			$n_jenis_wisata,
			$n_wilayah,
			$n_rating,
			$n_harga_tiket,
			$n_hari_operasional,
			$n_jam_operasional,
		];

		return $data;
	}

	public function get()
	{
		return $this->getData();
	}
}

// $data = new Data();
// $data->execute();

$weights = new Weights();

$scores = (new Moora($data, $weights))->moora();

$resp = [];
$resp["status"] = "success";
$resp["result"] = array();


$datas = $data->getDataWisata();

for ($i = 0; $i < sizeof($datas); $i++) {
	$data = $datas[$i];
	$data['score'] =  $scores[$i];
	$resp['result'][] = $data;
}


echo json_print($resp);
