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

$id_harga_tiket = id_otomatis("data_harga_tiket", "id_harga_tiket", "10");
$harga_tiket    = xss($_POST['harga_tiket']);
$nilai          = xss($_POST['nilai']);

$query = mysql_query("INSERT INTO data_harga_tiket VALUES (
    '$id_harga_tiket'
    ,'$harga_tiket'
    ,'$nilai'
)");

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_tambah";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>