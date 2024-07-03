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

$id_wisata   = xss($_POST['id_wisata']);
$nama_wisata = xss($_POST['nama_wisata']);
$foto        = ($_FILES['foto']['name']);

if (empty($foto)) {
    $foto = $_POST['foto1'];
} else {
    $foto = upload('foto');
};

$deskripsi           = xss($_POST['deskripsi']);
$koordinat           = xss($_POST['koordinat']);
$id_jenis_wisata     = xss($_POST['id_jenis_wisata']);
$id_wilayah          = xss($_POST['id_wilayah']);
$id_rating           = xss($_POST['id_rating']);
$id_harga_tiket      = xss($_POST['id_harga_tiket']);
$id_hari_operasional = xss($_POST['id_hari_operasional']);
$id_jam_operasional  = xss($_POST['id_jam_operasional']);

$query = mysql_query("UPDATE data_wisata set 
    nama_wisata='$nama_wisata',
    foto='$foto',
    deskripsi='$deskripsi',
    koordinat='$koordinat',
    id_jenis_wisata='$id_jenis_wisata',
    id_wilayah='$id_wilayah',
    id_rating='$id_rating',
    id_harga_tiket='$id_harga_tiket',
    id_hari_operasional='$id_hari_operasional',
    id_jam_operasional='$id_jam_operasional'

where id_wisata='$id_wisata' ") or die(mysql_error());

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_edit";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>