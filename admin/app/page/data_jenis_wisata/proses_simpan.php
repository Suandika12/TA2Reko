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


$id_jenis_wisata = id_otomatis("data_jenis_wisata", "id_jenis_wisata", "10");
              $jenis_wisata=xss($_POST['jenis_wisata']);
              $nilai=xss($_POST['nilai']);


$query = mysql_query("insert into data_jenis_wisata values (
'$id_jenis_wisata'
 ,'$jenis_wisata'
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
