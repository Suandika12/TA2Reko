
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
            $sql = mysql_query("SELECT * FROM data_hari_operasional where id_hari_operasional = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Hari Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_hari_operasional']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Hari Operasional </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['hari_operasional']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nilai </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nilai']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
