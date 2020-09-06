<?php
//pemanggilan file metatag
include "setting_metatag.php";
include 'header.php';
include 'config.php';

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
        $nama = mysqli_real_escape_string($conect, $_POST['nama_tanaman']);  //variabel dari name input nama
        $kategori = mysqli_real_escape_string($conect, $_POST['kategori']);     //variabel dari name input kategori
        $deskripsi = mysqli_real_escape_string($conect, $_POST['deskripsi']);     //variabel dari name input brand
        $stok = mysqli_real_escape_string($conect, $_POST['stok']);     //variabel dari name input stok
        $harga = mysqli_real_escape_string($conect, $_POST['harga']);     //variabel dari name input harga

        $select = mysqli_query($conect, "SELECT * FROM kategori WHERE Id_kategori ='$kategori'");
        $d = mysqli_fetch_array($select);
        $nama_kategori = $d['Kategori'];

        $foto = $_FILES['foto']['tmp_name'];               //variabel dari temporary foto
        $nama_foto = $_FILES['foto']['name'];             //variabel dari name input foto
        $type = $_FILES['foto']['type'];                   //variabel dari type foto
        $ukuran = $_FILES['foto']['size'];                 //variabel dari ukuran foto
        $files = strtolower(substr(strrchr($nama_foto, "."), 1)); //variabel untuk extensi file

        //jika menekan tombol simpan
        if (isset($_POST['simpan'])) {
            if (empty($nama)) {  //jika field nama kosong
                $er_nama = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Nama Produk </div>";
            } elseif (empty($kategori)) { //jika field kategori kosong
                $er_kategori = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Pilih Kategori Produk</div>";
            } elseif (empty($deskripsi)) { //jika field deskripsi kosong
                $er_deskripsi = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Deskripsi Produk</div>";
            } elseif (empty($harga)) { //jika field harga kosong
                $er_harga = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Harga Produk</div>";
            } elseif (empty($stok)) { //jika field stok kosong
                $er_stok = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Stok Produk</div>";
            } elseif (empty($foto)) {  //jika foto kosong
                $er_foto = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Masukan Foto Produk</div>";
            } elseif ($files != "jpg" && $files != "png") { //jika foto tidak berekstensi .jpg atau .png
                $er_foto = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Format Gambar yang diizinkan hanya .jpg dan .png</div>";
            } elseif ($ukuran > 2000000) {   //jika ukuran lebih besar dari 2MB
                $er_foto = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Maksimal ukuran gambar 2MB </div>";
            } elseif (strlen($nama_foto) > 100) {  //jika jumlah karakter nama foto lebih dari 100 karakter
                $er_foto = "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='fa fa-info-circle'></i> Nama File Gambar Mak 100 karakter</div>";
            } else { //jika semua field terpenuhi maka smpan gambar ke folder produk dan simpan data ke tb_produk
                move_uploaded_file($foto, "../../Aplikasi/img/bg-img/gambar_tanaman/$nama_kategori/$nama_foto");
                // $save = mysqli_query($connect, "INSERT INTO tb_produk (id_produk,nama_produk,id_brand,id_kategori,id_supplier,diskon_produk,berat_produk,harga_produk,stok_produk,gambar_produk,deskripsi_produk)
                // values('','$nama','$brand','$kategori','$supplier','$diskon','$berat','$harga','$stok','$nama_foto','$deskripsi')") or die(mysqli_error());
                $save = mysqli_query($conect, "INSERT INTO master_data VALUES ('','$nama','$stok','$harga','$deskripsi','$nama_foto','$kategori','$nama_kategori')");
                if ($save) { //jika simpan berhasil
                    echo "<script>alert('Data Berhasil Disimpan');document.location='master_data.php'</script>";
                } else {  //jika simpan gagal
                    $error = "<div class='alert alert-danger alert-dismissable'>
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
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Nama Tanaman</label>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Nama Tanaman" name="nama_tanaman" value="<?php echo $_POST['nama_tanaman']; ?>" maxlength="100">
                                </div>
                            </div>
                            <?php echo $er_nama; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Kategori Tanaman Hias</label>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <select name="kategori" class="form-control">
                                        <option value="">Pilih Kategori Tanaman</option>
                                        <?php $kategori = mysqli_query($conect, "select * from Kategori");
                                        while ($q = mysqli_fetch_array($kategori)) {
                                            if ($q['Id_kategori'] == $_POST['kategori']) {
                                                echo "
                                        <option value='$q[Id_kategori]' selected>$q[Kategori]</option>";
                                            } else {
                                                echo "
                                        <option value='$q[Id_kategori]'>$q[Kategori]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php echo $er_kategori; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Deskripsi Produk</label>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="deskripsi" class="form-control" id="editor1" rows="5" placeholder="Deskripsi Artikel"><?php echo $_POST['deskripsi']; ?></textarea>
                                </div>
                            </div>
                            <?php echo $er_deskripsi; ?>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Harga Tanaman</label>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="input-group"><span class="input-group-addon">Rp.</span>
                                        <input type="text" class="form-control" placeholder="Harga Tanaman" name="harga" value="<?php echo $_POST['harga']; ?>" maxlength="100">
                                    </div>
                                </div>
                            </div>
                            <?php echo $er_harga; ?>
                            <diva class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Stok Tanaman</label>
                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Stok Tanaman" name="stok" value="<?php echo $_POST['stok']; ?>" maxlength="100">
                                        <span class="input-group-addon">item</span></div>
                                </div>
                            </diva>
                            <?php echo $er_stok; ?>
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