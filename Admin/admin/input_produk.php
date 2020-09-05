<?php
//pemanggilan file metatag
include "setting_metatag.php";
include 'header.php';

//pemanggilan file navbar
include "setting_navbar.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">
        <!-- .row -->
        <!-- Page Heading  breadcumb-->
        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Daftar Produk
                </h3>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Home
                    </li>
                    <li class="active">
                        <i class="fa fa-list"></i> Daftar Produk
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <?php
        //variabel setiap input di form
        $nama = mysqli_real_escape_string($conect, $_POST['nama']);  //variabel dari name input nama
        $kategori = mysqli_real_escape_string($conect, $_POST['kategori']);     //variabel dari name input kategori
        $brand = mysqli_real_escape_string($conect, $_POST['brand']);     //variabel dari name input brand
        $supplier = mysqli_real_escape_string($conect, $_POST['supplier']);     //variabel dari name input supplier
        $deskripsi = mysqli_real_escape_string($conect, $_POST['deskripsi']);     //variabel dari name input deskripsi
        $stok = mysqli_real_escape_string($conect, $_POST['stok']);     //variabel dari name input stok
        $harga = mysqli_real_escape_string($conect, $_POST['harga']);     //variabel dari name input harga
        $diskon = mysqli_real_escape_string($conect, $_POST['diskon']);     //variabel dari name input diskon
        $berat = mysqli_real_escape_string($conect, $_POST['berat']);     //variabel dari name input berat

        $foto = $_FILES['foto']['tmp_name'];               //variabel dari temporary foto
        $nama_foto = $_FILES['foto']['name'];             //variabel dari name input foto
        $type = $_FILES['foto']['type'];                   //variabel dari type foto
        $ukuran = $_FILES['foto']['size'];                 //variabel dari ukuran foto
        $files = strtolower(substr(strrchr($nama_foto, "."), 1)); //variabel untuk extensi file

        //jika menekan tombol simpan
        if (isset($_POST['simpan'])) {
            if (empty($nama)) {  //jika field nama kosong
                $er_nama = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Nama Produk </div>";
            } elseif (empty($kategori)) { //jika field kategori kosong
                $er_kategori = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Pilih Kategori Produk</div>";
            } elseif (empty($brand)) { //jika field brand kosong
                $er_brand = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Pilih Brand / Merk Produk</div>";
            } elseif (empty($supplier)) { //jika field supplier kosong
                $er_supplier = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Pilih Supplier Produk</div>";
            } elseif (empty($deskripsi)) { //jika field deskripsi kosong
                $er_deskripsi = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Deskripsi Produk</div>";
            } elseif (empty($harga)) { //jika field harga kosong
                $er_harga = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Harga Produk</div>";
            } elseif (empty($stok)) { //jika field stok kosong
                $er_stok = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Stok Produk</div>";
            } elseif (empty($berat)) { //jika field berat kosong
                $er_berat = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Berat Produk</div>";
            } elseif (empty($foto)) {  //jika foto kosong
                $er_foto = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Foto Produk</div>";
            } elseif ($files != "jpg" && $files != "png") { //jika foto tidak berekstensi .jpg atau .png
                $er_foto = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Format Gambar yang diizinkan hanya .jpg dan .png</div>";
            } elseif ($ukuran > 2000000) {   //jika ukuran lebih besar dari 2MB
                $er_foto = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Maksimal ukuran gambar 2MB </div>";
            } elseif (strlen($nama_foto) > 100) {  //jika jumlah karakter nama foto lebih dari 100 karakter
                $er_foto = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Nama File Gambar Mak 100 karakter</div>";
            } else { //jika semua field terpenuhi maka smpan gambar ke folder produk dan simpan data ke tb_produk
                move_uploaded_file($foto, "../assets/images/produk/$nama_foto");
                $save = mysql_query("INSERT INTO tb_produk (id_produk,nama_produk,id_brand,id_kategori,id_supplier,diskon_produk,berat_produk,harga_produk,stok_produk,gambar_produk,deskripsi_produk)
                values('','$nama','$brand','$kategori','$supplier','$diskon','$berat','$harga','$stok','$nama_foto','$deskripsi')") or die(mysql_error());
                if ($save) { //jika simpan berhasil
                    echo "<script>alert('Data Berhasil Disimpan');document.location='produk.php'</script>";
                } else {  //jika simpan gagal
                    $error = "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Error</div>";
                }
            }
        }
        ?>
        <!-- .row -->
        <div class="row">

            <!-- .col lg 12 -->
            <div class="col-lg-12">

                <!-- panel . (Pelajari cara membuat panel di bootstrap yah)-->
                <div class="panel panel-default">

                    <!-- panel heading -->
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a href="produk.php" title="Input data"><button name="input" class="btn btn-primary">Kembali</button></a>
                        </h3>
                    </div>
                    <!-- /.panel heading -->

                    <!-- panel body -->
                    <div class="panel-body">

                        <!-- /.form menggunakan form group, pelajari cara membuat form di bootstrap-->

                        <form action="" method="post" enctype="multipart/form-data" role="form">
                            <?php echo $error; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Nama Produk</label>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Nama Produk" name="nama" value="<?php echo $_POST['nama']; ?>" maxlength="100">
                                </div>
                            </div>
                            <?php echo $er_nama; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Kategori Produk</label>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <select name="kategori" class="form-control">
                                        <option value="">Pilih Kategori Produk</option>
                                        <?php $kategori = mysqli_query($conect, "select *from tb_kategori");
                                        while ($q = mysqli_fetch_array($kategori)) {
                                            if ($q['id_kategori'] == $_POST['kategori']) {
                                                echo "
                                        <option value='$q[id_kategori]' selected>$q[nama_kategori]</option>";
                                            } else {
                                                echo "
                                        <option value='$q[id_kategori]'>$q[nama_kategori]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php echo $er_kategori; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Brand / Merk Produk</label>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <select name="brand" class="form-control">
                                        <option value="">Pilih Brand / Merk Produk</option>
                                        <?php $brand = mysqli_query($conect, "select *from tb_brand");
                                        while ($c = mysqli_fetch_array($brand)) {
                                            if ($c['id_brand'] == $_POST['brand']) {
                                                echo "
                                        <option value='$c[id_brand]' selected>$c[nama_brand]</option>";
                                            } else {
                                                echo "
                                        <option value='$c[id_brand]'>$c[nama_brand]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php echo $er_brand; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Supplier Produk</label>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <select name="supplier" class="form-control">
                                        <option value="">Pilih Supplier Produk</option>
                                        <?php $supplier = mysqli_query($conect, "select *from tb_supplier");
                                        while ($d = mysqli_fetch_array($supplier)) {
                                            if ($d['id_supplier'] == $_POST['supplier']) {
                                                echo "
                                        <option value='$d[id_supplier]' selected>$d[nama_supplier]</option>";
                                            } else {
                                                echo "
                                        <option value='$d[id_supplier]'>$d[nama_supplier]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php echo $er_supplier; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Deskripsi Produk</label>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="deskripsi" class="form-control" id="editor1" rows="5" placeholder="Deskripsi Artikel"><?php echo $_POST['deskripsi']; ?></textarea>
                                </div>
                            </div>
                            <?php echo $er_deskripsi; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Harga Produk</label>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="input-group"><span class="input-group-addon">Rp.</span>
                                        <input type="text" class="form-control" placeholder="Harga Produk" name="harga" value="<?php echo $_POST['harga']; ?>" maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <?php echo $er_harga; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Stok Produk</label>
                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Stok Produk" name="stok" value="<?php echo $_POST['stok']; ?>" maxlength="100">
                                        <span class="input-group-addon">item</span></div>
                                </div>
                            </div>
                            <?php echo $er_stok; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Berat Produk (gram)</label>
                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Berat Produk dalam gram" name="berat" value="<?php echo $_POST['berat']; ?>" maxlength="100">
                                        <span class="input-group-addon">gram</span></div>
                                </div>
                            </div>
                            <?php echo $er_berat; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Diskon Produk</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="Diskon Produk" name="diskon" value="<?php echo $_POST['diskon']; ?>" maxlength="3">
                                        <span class="input-group-addon">%</span></div>
                                </div>
                            </div>
                            <?php echo $er_diskon; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Gambar Produk</label>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <input type="file" class="form-control-file" name="foto" accept=".jpg, .png">
                                </div>
                            </div>
                            <?php echo $er_foto; ?>
                            <hr>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>

                        </form>
                        <!-- /.form -->

                    </div>
                    <!-- /.panel body -->

                </div>
                <!-- /.panel -->

            </div>
            <!-- /.col lg 12-->

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
//pemanggilan file setting footer
include "setting_footer.php";

?>