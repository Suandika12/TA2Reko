    <?php

    require_once('../../../include/all_include.php');

    $resp = [];
    $resp["status"] = "success";
    $resp["result"] = array();

    // Membuat koneksi menggunakan MySQLi
    $mysqli = new mysqli("localhost", "root", "", "db_wisata");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    class QueryBuilder
    {
        private $query = "";

        public function add($query)
        {
            if ($this->query != "") {
                $this->query .= " AND ";
            }
            $this->query .= $query;
        }

        public function get()
        {
            if ($this->query != "") {
                $this->query = " WHERE " . $this->query;
            }
            return $this->query;
        }
    }

    $bquery = new QueryBuilder();

    $id_jenis_wisata = isset($_GET['id_jenis_wisata']) ? $mysqli->real_escape_string($_GET['id_jenis_wisata']) : "";
    $id_wilayah = isset($_GET['id_wilayah']) ? $mysqli->real_escape_string($_GET['id_wilayah']) : "";
    $id_rating = isset($_GET['id_rating']) ? $mysqli->real_escape_string($_GET['id_rating']) : "";
    $id_harga_tiket = isset($_GET['id_harga_tiket']) ? $mysqli->real_escape_string($_GET['id_harga_tiket']) : "";
    $id_hari_operasional = isset($_GET['id_hari_operasional']) ? $mysqli->real_escape_string($_GET['id_hari_operasional']) : "";
    $id_jam_operasional = isset($_GET['id_jam_operasional']) ? $mysqli->real_escape_string($_GET['id_jam_operasional']) : "";

    $query = "SELECT * FROM data_wisata";

    if ($id_jenis_wisata != "") {
        $search_query = "id_jenis_wisata = '$id_jenis_wisata'";
        $bquery->add($search_query);
    }

    if ($id_wilayah != "") {
        $search_query = "id_wilayah = '$id_wilayah'";
        $bquery->add($search_query);
    }

    if ($id_rating != "") {
        $search_query = "id_rating = '$id_rating'";
        $bquery->add($search_query);
    }

    if ($id_harga_tiket != "") {
        $search_query = "id_harga_tiket = '$id_harga_tiket'";
        $bquery->add($search_query);
    }

    if ($id_hari_operasional != "") {
        $search_query = "id_hari_operasional = '$id_hari_operasional'";
        $bquery->add($search_query);
    }

    if ($id_jam_operasional != "") {
        $search_query = "id_jam_operasional = '$id_jam_operasional'";
        $bquery->add($search_query);
    }

    $query .= $bquery->get();

    $result = $mysqli->query($query);
    while ($data = $result->fetch_assoc()) {

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

    $mysqli->close();
    ?>
