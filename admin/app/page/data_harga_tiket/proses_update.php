<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_harga_tiket'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_harga_tiket = xss($_POST['id_harga_tiket']);
$harga_tiket = xss($_POST['harga_tiket']);
$nilai = xss($_POST['nilai']);


$query = mysql_query("update data_harga_tiket set 
harga_tiket='$harga_tiket',
nilai='$nilai'

where id_harga_tiket='$id_harga_tiket' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
