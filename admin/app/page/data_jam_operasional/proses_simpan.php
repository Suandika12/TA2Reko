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


$id_jam_operasional = id_otomatis("data_jam_operasional", "id_jam_operasional", "10");
              $jam_operasional=xss($_POST['jam_operasional']);
              $nilai=xss($_POST['nilai']);


$query = mysql_query("insert into data_jam_operasional values (
'$id_jam_operasional'
 ,'$jam_operasional'
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
