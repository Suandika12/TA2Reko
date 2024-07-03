
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-content">
        <table <?php tabel_in(100, '%', 0, 'center'); ?>>		
            <tbody>
               
                <?php
                if (!isset($_GET['proses'])) {
                        
                    ?>
                <script>
                    alert("AKSES DITOLAK");
                    location.href = "index.php";
                </script>
                <?php
                die();
            }
            $proses = decrypt(mysql_real_escape_string($_GET['proses']));
            $sql = mysql_query("SELECT * FROM data_wisata where id_wisata = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Wisata </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_wisata']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama Wisata </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nama_wisata']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Foto </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft">
                  <a href="../../../../admin/upload/<?php echo $data['foto']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['foto']; ?>"></a>
                    <br>
                  <?php echo $data['foto']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Deskripsi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['deskripsi']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Koordinat </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['koordinat']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jenis Wisata </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","jenis_wisata","select * from data_jenis_wisata where id_jenis_wisata='$data[id_jenis_wisata]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Wilayah </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","wilayah","select * from data_wilayah where id_wilayah='$data[id_wilayah]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Rating </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","rating","select * from data_rating where id_rating='$data[id_rating]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Harga Tiket </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","harga_tiket","select * from data_harga_tiket where id_harga_tiket='$data[id_harga_tiket]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Hari Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","hari_operasional","select * from data_hari_operasional where id_hari_operasional='$data[id_hari_operasional]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jam Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","jam_operasional","select * from data_jam_operasional where id_jam_operasional='$data[id_jam_operasional]'")  ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
