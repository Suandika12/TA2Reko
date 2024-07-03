<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_rating'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_rating = xss($_POST['id_rating']);
$rating = xss($_POST['rating']);
$nilai = xss($_POST['nilai']);


$query = mysql_query("update data_rating set 
rating='$rating',
nilai='$nilai'

where id_rating='$id_rating' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
