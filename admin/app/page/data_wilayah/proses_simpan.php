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


$id_wilayah = id_otomatis("data_wilayah", "id_wilayah", "10");
              $wilayah=xss($_POST['wilayah']);
              $nilai=xss($_POST['nilai']);


$query = mysql_query("insert into data_wilayah values (
'$id_wilayah'
 ,'$wilayah'
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
