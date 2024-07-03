<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_jenis_wisata'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_jenis_wisata = xss($_POST['id_jenis_wisata']);
$jenis_wisata = xss($_POST['jenis_wisata']);
$nilai = xss($_POST['nilai']);


$query = mysql_query("update data_jenis_wisata set 
jenis_wisata='$jenis_wisata',
nilai='$nilai'

where id_jenis_wisata='$id_jenis_wisata' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
