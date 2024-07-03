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


$id_hari_operasional = id_otomatis("data_hari_operasional", "id_hari_operasional", "10");
              $hari_operasional=xss($_POST['hari_operasional']);
              $nilai=xss($_POST['nilai']);


$query = mysql_query("insert into data_hari_operasional values (
'$id_hari_operasional'
 ,'$hari_operasional'
 ,'$nilai'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
