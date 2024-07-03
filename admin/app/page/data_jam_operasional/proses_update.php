<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_jam_operasional'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_jam_operasional = xss($_POST['id_jam_operasional']);
$jam_operasional = xss($_POST['jam_operasional']);
$nilai = xss($_POST['nilai']);


$query = mysql_query("update data_jam_operasional set 
jam_operasional='$jam_operasional',
nilai='$nilai'

where id_jam_operasional='$id_jam_operasional' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
