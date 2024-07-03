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


$id_rating = id_otomatis("data_rating", "id_rating", "10");
              $rating=xss($_POST['rating']);
              $nilai=xss($_POST['nilai']);


$query = mysql_query("insert into data_rating values (
'$id_rating'
 ,'$rating'
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
