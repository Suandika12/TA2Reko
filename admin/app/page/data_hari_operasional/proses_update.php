<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_hari_operasional'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_hari_operasional = xss($_POST['id_hari_operasional']);
$hari_operasional = xss($_POST['hari_operasional']);
$nilai = xss($_POST['nilai']);


$query = mysql_query("update data_hari_operasional set 
hari_operasional='$hari_operasional',
nilai='$nilai'

where id_hari_operasional='$id_hari_operasional' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
