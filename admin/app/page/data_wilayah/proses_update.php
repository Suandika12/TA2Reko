<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_wilayah'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_wilayah = xss($_POST['id_wilayah']);
$wilayah = xss($_POST['wilayah']);
$nilai = xss($_POST['nilai']);


$query = mysql_query("update data_wilayah set 
wilayah='$wilayah',
nilai='$nilai'

where id_wilayah='$id_wilayah' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
