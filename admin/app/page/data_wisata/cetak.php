<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    action_cetak("data_wisata");
} else {

    function location() {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_wisata");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        if (isset($_GET['export'])) {
            
        } else {
            ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100"></td>

                <td class="auto-style1">
            <center>
                <h2 class="auto-style1"><?php echo $judul; ?></h2>
            </center>
        </td>

        <td class="auto-style1" rowspan="3" width="101">
            <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100"></td>
        </tr>
    <?php } ?>

    <tr>
        <td class="auto-style2">
    <center>
        <strong>LAPORAN

            <?php
            $tabelnya = "data_wisata";
            $tabelnya = str_replace("_", " ", $tabelnya);
            $tabelnya = str_replace("data", "", $tabelnya);
            $tabelnya = strtoupper($tabelnya);
            echo $tabelnya;
            ?>

        </strong>
    </center>
    </td>
    </tr>

    <tr>
        <td class="auto-style2"><?php echo $alamat; ?></td>
    </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%"  class="tblcms2">
        <tr>
            <th class="th_border cell">No</th>
           <!--h <th class="th_border cell">Id Wisata </th> h-->
                <th align="center" class="th_border cell"  >Nama Wisata </th>
                <th align="center" class="th_border cell"  >Foto </th>
                <th align="center" class="th_border cell"  >Deskripsi </th>
                <th align="center" class="th_border cell"  >Koordinat </th>
                <th align="center" class="th_border cell"  >Jenis Wisata </th>
                <th align="center" class="th_border cell"  >Wilayah </th>
                <th align="center" class="th_border cell"  >Rating </th>
                <th align="center" class="th_border cell"  >Harga Tiket </th>
                <th align="center" class="th_border cell"  >Hari Operasional </th>
                <th align="center" class="th_border cell"  >Jam Operasional </th>


        </tr>

        <tbody>
            <?php
            $no = 0;
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_wisata where $Berdasarkan like '%$isi%'";
            } else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';
                $querytabel = "SELECT * FROM data_wisata where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_wisata";
            }
            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1; echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_wisata']; ?></td> h-->
                        <td align="center"><?php echo $data['nama_wisata']; ?></td>
                        <td align="center"><a href="../../../../admin/upload/<?php echo $data['foto']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['foto']; ?>"></a></td>
                        <td align="center"><?php echo $data['deskripsi']; ?></td>
                        <td align="center"><?php echo $data['koordinat']; ?></td>
                        <td align="center"><?php echo baca_database("","jenis_wisata","select * from data_jenis_wisata where id_jenis_wisata='$data[id_jenis_wisata]'")  ?></td>
                        <td align="center"><?php echo baca_database("","wilayah","select * from data_wilayah where id_wilayah='$data[id_wilayah]'")  ?></td>
                        <td align="center"><?php echo baca_database("","rating","select * from data_rating where id_rating='$data[id_rating]'")  ?></td>
                        <td align="center"><?php echo baca_database("","harga_tiket","select * from data_harga_tiket where id_harga_tiket='$data[id_harga_tiket]'")  ?></td>
                        <td align="center"><?php echo baca_database("","hari_operasional","select * from data_hari_operasional where id_hari_operasional='$data[id_hari_operasional]'")  ?></td>
                        <td align="center"><?php echo baca_database("","jam_operasional","select * from data_jam_operasional where id_jam_operasional='$data[id_jam_operasional]'")  ?></td>



                </tr>
    <?php } ?>
        </tbody>
    </table>
    <!-- BODY -->

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?>
    </p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
    <p class="auto-style3"></p>

<?php } ?>
