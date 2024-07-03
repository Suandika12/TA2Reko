<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_bobot'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_bobot = xss($_POST['id_bobot']);
$jenis_wisata = xss($_POST['jenis_wisata']);
$wilayah = xss($_POST['wilayah']);
$rating = xss($_POST['rating']);
$harga_tiket = xss($_POST['harga_tiket']);
$hari_operasional = xss($_POST['hari_operasional']);
$jam_operasional = xss($_POST['jam_operasional']);


$query = mysql_query("update data_bobot set 
jenis_wisata='$jenis_wisata',
wilayah='$wilayah',
rating='$rating',
harga_tiket='$harga_tiket',
hari_operasional='$hari_operasional',
jam_operasional='$jam_operasional'

where id_bobot='$id_bobot' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
