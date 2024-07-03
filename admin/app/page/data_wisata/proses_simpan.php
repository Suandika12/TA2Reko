<?php

include '../../../include/all_include.php';

if (!isset($_POST['id_wisata'])) {
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}

$id_wisata           = id_otomatis("data_wisata", "id_wisata", "10");
$nama_wisata         = xss($_POST['nama_wisata']);
$foto                = upload('foto');
$deskripsi           = xss($_POST['deskripsi']);
$koordinat           = xss($_POST['koordinat']);
$id_jenis_wisata     = xss($_POST['id_jenis_wisata']);
$id_wilayah          = xss($_POST['id_wilayah']);
$id_rating           = xss($_POST['id_rating']);
$id_harga_tiket      = xss($_POST['id_harga_tiket']);
$id_hari_operasional = xss($_POST['id_hari_operasional']);
$id_jam_operasional  = xss($_POST['id_jam_operasional']);

$query = mysql_query("INSERT INTO data_wisata VALUES (
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

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_tambah";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>