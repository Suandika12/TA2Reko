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


$id_bobot = id_otomatis("data_bobot", "id_bobot", "10");
              $jenis_wisata=xss($_POST['jenis_wisata']);
              $wilayah=xss($_POST['wilayah']);
              $rating=xss($_POST['rating']);
              $harga_tiket=xss($_POST['harga_tiket']);
              $hari_operasional=xss($_POST['hari_operasional']);
              $jam_operasional=xss($_POST['jam_operasional']);


$query = mysql_query("insert into data_bobot values (
'$id_bobot'
 ,'$jenis_wisata'
 ,'$wilayah'
 ,'$rating'
 ,'$harga_tiket'
 ,'$hari_operasional'
 ,'$jam_operasional'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
