<?php
require_once('../../../include/all_include.php');
$resp = [];
$resp["status"] = "success";
$resp["result"] = array();


// Step 1: Define the criteria weights
$criteriaWeights = getWeights();

// ambil semua data wisata
$dataWisata = getDataWisata();

// Step 2: Create decision matrix (not shown, should be user input or fetched from database)
$decisionMatrix = getDecisionMatrix($dataWisata);

// Step 3: Normalize decision matrix
$normalizedMatrix = normalizeMatrix($decisionMatrix);

// Step 4: Multiply normalized matrix by criteria weights
$weightedMatrix = multiplyByWeights($normalizedMatrix, $criteriaWeights);

// Step 5: Calculate total for each destination
$totals = calculateTotals($weightedMatrix, $dataWisata);

// Step 6: Rank destinations based on totals
$ranked = rankDestinations($totals);

// Step 7: Filter data wisata by key ranked
$resultRanked = matchingDataWisataByDataRanked($ranked, $dataWisata);

// Step 8: Check filter data by filtering user input
$result = filterResult($resultRanked);

// Step 8: Return ranked destinations
$resp["result"] = $result;

jsonPrint($resp);
// }

// ambil nilai bobot
function getWeights()
{
    $result = array();
    $queryWeight = mysql_query("SELECT * FROM data_bobot");
    while ($data = mysql_fetch_array($queryWeight)) {
        foreach ($data as $key => $value) {
            if (!is_numeric($key)) {
                $result[$key] = $value;
            }
        }
    }
    array_splice($result, 0, 1);
    return $result;
}
function getDataWisata() {
    $result = [];
    $queryDataWisata = mysql_query("SELECT * FROM data_wisata");

    while ($data = mysql_fetch_array($queryDataWisata)) {
        $hasil = [];
        $hasil['id_wisata'] = $data["id_wisata"];
        $hasil['nama_wisata'] = $data["nama_wisata"];
        $hasil['foto'] = $data["foto"];
        $hasil['deskripsi'] = $data["deskripsi"];
        $hasil['koordinat'] = $data["koordinat"];

        // Mengambil detail kriteria dari tabel terkait
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
        $hasil['jam_operasional'] = baca_database("", "jam_operasional", "SELECT * FROM data_jam_operasional WHERE id_jam_operasional='$data[id_jam_operasional]'");

        array_push($result, $hasil);
    }
    return $result;
}


function getDecisionMatrix($data)
{
    // ambil nilai jenis wisata
    $queryJenisWisata = mysql_query("SELECT * FROM data_jenis_wisata");
    // ambil nilai wilayah
    $queryWilayah = mysql_query("SELECT * FROM data_wilayah");
    // ambil nilai rating
    $queryRating = mysql_query("SELECT * FROM data_rating");
    // ambil nilai harga tiket
    $queryHargaTiket = mysql_query("SELECT * FROM data_harga_tiket");;
    // ambil nilai hari operasional
    $queryHariOperasional = mysql_query("SELECT * FROM data_hari_operasional");
    // ambil nilai jam operasional
    $queryJamOperasional = mysql_query("SELECT * FROM data_jam_operasional");

    $result = [];
    for ($i = 0; $i < count($data); $i++) {
        $dataWisata = $data[$i];
        $idJenisWisata = getValue($queryJenisWisata, 'id_jenis_wisata', $dataWisata['id_jenis_wisata']);
        $idWilayah = getValue($queryWilayah, 'id_wilayah', $dataWisata['id_wilayah']);
        $idRating = getValue($queryRating, 'id_rating', $dataWisata['id_rating']);
        $idHargaTiket = getValue($queryHargaTiket, 'id_harga_tiket', $dataWisata['id_harga_tiket']);
        $idHariOperasional = getValue($queryHariOperasional, 'id_hari_operasional', $dataWisata['id_hari_operasional']);
        $idJamOperasional = getValue($queryJamOperasional, 'id_jam_operasional', $dataWisata['id_jam_operasional']);
        $result[$i] = array($idJenisWisata, $idWilayah, $idRating, $idHargaTiket, $idHariOperasional, $idJamOperasional);

        // Reset pointer hasil query
        mysql_data_seek($queryJenisWisata, 0);
        mysql_data_seek($queryWilayah, 0);
        mysql_data_seek($queryRating, 0);
        mysql_data_seek($queryHargaTiket, 0);
        mysql_data_seek($queryHariOperasional, 0);
        mysql_data_seek($queryJamOperasional, 0);
    }

    return $result;
}

// ambil nilai matrix dari masing-masing wisata pada kolom kriteria
function getValue($queryData, $nameKey, $id)
{
    while ($data = mysql_fetch_assoc($queryData)) {
        if ($data[$nameKey] == $id) {
            return $data['nilai'];
        }
    }
}

// normalisasi matrix
function normalizeMatrix($decision_matrix)
{
    $normalized_matrix = array();
    $num_criteria = count($decision_matrix[array_key_first($decision_matrix)]); // assuming all rows have the same number of criteria values
    for ($col = 0; $col < $num_criteria; $col++) {
        $squared_sum = 0;
        foreach ($decision_matrix as $key => $criteria_values) {
            $squared_sum += pow($criteria_values[$col], 2);
        }
        $sqrt_sum = sqrt($squared_sum);
        foreach ($decision_matrix as $key => $criteria_values) {
            $normalized_matrix[$key][] = $criteria_values[$col] / $sqrt_sum;
        }
    }
    return $normalized_matrix;
}

// Step 4: Multiply normalized matrix by criteria weights
function multiplyByWeights($normalized_matrix, $criteria_weights)
{
    $weighted_matrix = array();
    foreach ($normalized_matrix as $key => $criteria_values) {
        foreach ($criteria_values as $col => $value) {
            $criteria_key = array_keys($criteria_weights)[$col]; // Get the key of criteria weight
            $weighted_matrix[$key][$col] = $value * $criteria_weights[$criteria_key];
        }
    }
    return $weighted_matrix;
}


// Step 5: Calculate total for each destination
function calculateTotals($weighted_matrix, $dataWisata)
{
    $totals = array();
    $index = 1;
    foreach ($weighted_matrix as $wisata => $criteria_values) {
        $idWisata = $dataWisata[$index - 1]['id_wisata'];
        $totals[$idWisata] = array_sum($criteria_values);
        $index++;
    }
    return $totals;
}

// Step 6: Rank destinations based on totals
function rankDestinations($totals)
{
    arsort($totals); // Sort in descending order
    return $totals;
}

function matchingDataWisataByDataRanked($ranked, $dataWisata)
{
    usort($dataWisata, function ($a, $b) use ($ranked) {
        return $ranked[$b["id_wisata"]] <=> $ranked[$a["id_wisata"]];
    });

    // add value ranked into dataWisata
    $index = 0;
    foreach ($ranked as $key => $value) {
        $dataWisata[$index]['score'] = $value;
        $index++;
    }

    return $dataWisata;
}

function filterResult($resultRanked)
{
    $filters = [
        'id_jenis_wisata' => isset($_GET['id_jenis_wisata']) ? $_GET['id_jenis_wisata'] : null,
        'id_wilayah' => isset($_GET['id_wilayah']) ? $_GET['id_wilayah'] : null,
        'id_rating' => isset($_GET['id_rating']) ? $_GET['id_rating'] : null,
        'id_harga_tiket' => isset($_GET['id_harga_tiket']) ? $_GET['id_harga_tiket'] : null,
        'id_hari_operasional' => isset($_GET['id_hari_operasional']) ? $_GET['id_hari_operasional'] : null,
        'id_jam_operasional' => isset($_GET['id_jam_operasional']) ? $_GET['id_jam_operasional'] : null
    ];

    $result = array_filter($resultRanked, function ($item) use ($filters) {
        foreach ($filters as $key => $value) {
            if (!is_null($value) && $item[$key] != $value) {
                return false;
            }
        }
        return true;
    });

    return array_values($result);
}


function jsonPrint($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}
