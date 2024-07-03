
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Wisata </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Wisata  dibawah ini.</p>
        </div>
    </div>


<div class="content-box">
    <form action="proses_update.php"  enctype="multipart/form-data"  method="post">
        <div class="content-box-content">
            <div id="postcustom">	
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
                        <td width="25%" class="leftrowcms">					
                            <label >Id Wisata  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_wisata']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_wisata" value="<?php echo $data['id_wisata']; ?>" readonly  id="id_wisata" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Wisata  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nama_wisata" id="nama_wisata" placeholder="Nama Wisata " required="required" value="<?php echo ($data['nama_wisata']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Foto  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                 <a href="../../../../admin/upload/<?php echo $data['foto']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['foto']; ?>"></a>
                                 <input value="<?php echo ($data['foto']); ?>" class="form-control" style="width:50%" type="hidden" name="foto1" id="foto1" placeholder="Foto  ">
                                 <input value="<?php echo ($data['foto']); ?>" class="form-control" style="width:50%" type="file" name="foto" id="foto" placeholder="Foto  ">

                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Deskripsi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi " required="required"><?php echo ($data['deskripsi']); ?></textarea>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Koordinat  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="koordinat" id="koordinat" placeholder="Koordinat " required="required" value="<?php echo ($data['koordinat']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jenis Wisata  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_jenis_wisata" id="id_jenis_wisata" placeholder="Id Jenis Wisata " required="required">
                                <option value="<?php echo ($data['id_jenis_wisata']); ?>">- <?php echo baca_database("","jenis_wisata","select * from data_jenis_wisata where id_jenis_wisata='$data[id_jenis_wisata]'"); ?> -</option><?php combo_database_v2('data_jenis_wisata','id_jenis_wisata','jenis_wisata',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Wilayah  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_wilayah" id="id_wilayah" placeholder="Id Wilayah " required="required">
                                <option value="<?php echo ($data['id_wilayah']); ?>">- <?php echo baca_database("","wilayah","select * from data_wilayah where id_wilayah='$data[id_wilayah]'"); ?> -</option><?php combo_database_v2('data_wilayah','id_wilayah','wilayah',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Rating  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_rating" id="id_rating" placeholder="Id Rating " required="required">
                                <option value="<?php echo ($data['id_rating']); ?>">- <?php echo baca_database("","rating","select * from data_rating where id_rating='$data[id_rating]'"); ?> -</option><?php combo_database_v2('data_rating','id_rating','rating',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Harga Tiket  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_harga_tiket" id="id_harga_tiket" placeholder="Id Harga Tiket " required="required">
                                <option value="<?php echo ($data['id_harga_tiket']); ?>">- <?php echo baca_database("","harga_tiket","select * from data_harga_tiket where id_harga_tiket='$data[id_harga_tiket]'"); ?> -</option><?php combo_database_v2('data_harga_tiket','id_harga_tiket','harga_tiket',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Hari Operasional  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hari_operasional" id="id_hari_operasional" placeholder="Id Hari Operasional " required="required">
                                <option value="<?php echo ($data['id_hari_operasional']); ?>">- <?php echo baca_database("","hari_operasional","select * from data_hari_operasional where id_hari_operasional='$data[id_hari_operasional]'"); ?> -</option><?php combo_database_v2('data_hari_operasional','id_hari_operasional','hari_operasional',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jam Operasional  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_jam_operasional" id="id_jam_operasional" placeholder="Id Jam Operasional " required="required">
                                <option value="<?php echo ($data['id_jam_operasional']); ?>">- <?php echo baca_database("","jam_operasional","select * from data_jam_operasional where id_jam_operasional='$data[id_jam_operasional]'"); ?> -</option><?php combo_database_v2('data_jam_operasional','id_jam_operasional','jam_operasional',''); ?>
                                </select>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                    </center>
                </div>		
            </div>
        </div>
    </form>
