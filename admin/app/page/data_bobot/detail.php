
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
            $sql = mysql_query("SELECT * FROM data_bobot where id_bobot = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Bobot </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_bobot']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Jenis Wisata </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jenis_wisata']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Wilayah </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['wilayah']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Rating </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['rating']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Harga Tiket </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['harga_tiket']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Hari Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['hari_operasional']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jam Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jam_operasional']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
