<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Wisata </strong>
        <hr class="message-inner-separator">
        <p>Silahkan input Data Wisata dibawah ini.</p>
    </div>
</div>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id Wisata  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_wisata", "id_wisata", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_wisata", "id_wisata", "10"); ?>" name="id_wisata" placeholder="Id Wisata " id="id_wisata" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Wisata <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="nama_wisata" id="nama_wisata" placeholder="Nama Wisata " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Foto <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="file" name="foto" id="foto" placeholder="Foto " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Deskripsi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi " required="required"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Koordinat <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="koordinat" id="koordinat" placeholder="Koordinat " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jenis Wisata <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_jenis_wisata" id="id_jenis_wisata" placeholder="Id Jenis Wisata " required="required">
                                    <option></option><?php combo_database_v2('data_jenis_wisata', 'id_jenis_wisata', 'jenis_wisata', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Wilayah <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_wilayah" id="id_wilayah" placeholder="Id Wilayah " required="required">
                                    <option></option><?php combo_database_v2('data_wilayah', 'id_wilayah', 'wilayah', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Rating <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_rating" id="id_rating" placeholder="Id Rating " required="required">
                                    <option></option><?php combo_database_v2('data_rating', 'id_rating', 'rating', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Harga Tiket <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_harga_tiket" id="id_harga_tiket" placeholder="Id Harga Tiket " required="required">
                                    <option></option><?php combo_database_v2('data_harga_tiket', 'id_harga_tiket', 'harga_tiket', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Hari Operasional <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_hari_operasional" id="id_hari_operasional" placeholder="Id Hari Operasional " required="required">
                                    <option></option><?php combo_database_v2('data_hari_operasional', 'id_hari_operasional', 'hari_operasional', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jam Operasional <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_jam_operasional" id="id_jam_operasional" placeholder="Id Jam Operasional " required="required">
                                    <option></option><?php combo_database_v2('data_jam_operasional', 'id_jam_operasional', 'jam_operasional', ''); ?>
                                </select>
                            </td>
                        </tr>



                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' PROSES SIMPAN DATA'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>