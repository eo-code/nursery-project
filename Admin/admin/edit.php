<?php
include 'header.php';
include 'config.php';

if (isset($_POST['simpan'])) {
	//variabel
	$id = $_POST['id'];
	$nama = mysqli_real_escape_string($conect, $_POST['nama_tanaman']);  //variabel dari name input nama
	$kategori = mysqli_real_escape_string($conect, $_POST['kategori']);     //variabel dari name input kategori
	$deskripsi = mysqli_real_escape_string($conect, $_POST['deskripsi']);     //variabel dari name input brand
	$stok = mysqli_real_escape_string($conect, $_POST['stok']);     //variabel dari name input stok
	$harga = mysqli_real_escape_string($conect, $_POST['harga']);     //variabel dari name input harga

	$select = mysqli_query($conect, "SELECT * FROM kategori WHERE Id_kategori ='$kategori'");
	$d = mysqli_fetch_array($select);
	$nama_kategori = $d['Kategori'];
	$kategori_lama = $_POST['kategori_lama'];
	$foto_lama = $_POST['foto_lama'];

	$foto = $_FILES['foto']['tmp_name'];               //variabel dari temporary foto
	$nama_foto = $_FILES['foto']['name'];             //variabel dari name input foto
	$type = $_FILES['foto']['type'];                   //variabel dari type foto
	$ukuran = $_FILES['foto']['size'];                 //variabel dari ukuran foto
	$files = strtolower(substr(strrchr($nama_foto, "."), 1)); //variabel untuk extensi file
	//foto gada
	if ($nama_foto == "") {
		//ganti kategori
		if ($kategori_lama != $nama_kategori) {
			$lama = "../../Aplikasi/img/bg-img/gambar_tanaman/$kategori_lama/$foto_lama";
			$baru =  "../../Aplikasi/img/bg-img/gambar_tanaman/$nama_kategori/$foto_lama";
			rename($lama, $baru);
			$update = mysqli_query($conect, "UPDATE master_data SET Nama_tanaman='$nama', Stok='$stok', Harga_jual='$harga', Keterangan='$deskripsi',Id_kategori='$kategori',Kategori='$nama_kategori' WHERE Id_master_data = '$id'");
			if ($update) {
				echo "<script>alert('Data Berhasil Di Update');document.location='master_data.php'</script>";
			}
		} else {
			$update = mysqli_query($conect, "UPDATE master_data SET Nama_tanaman='$nama', Stok='$stok', Harga_jual='$harga', Keterangan='$deskripsi',Id_kategori='$kategori',Kategori='$nama_kategori' WHERE Id_master_data = '$id'");
			if ($update) {
				echo "<script>alert('Data Berhasil Di Update');document.location='master_data.php'</script>";
			}
		}
	} else {
		if ($files != "jpg" && $files != "png") { //jika foto tidak berekstensi .jpg atau .png
			echo "<script>alert('format tidak didukung')</script>";
		} elseif ($ukuran > 2000000) {   //jika ukuran lebih besar dari 2MB
			echo "<script>alert('Ukuran melebihi 2MB')</script>";
		} elseif (strlen($nama_foto) > 100) {  //jika jumlah karakter nama foto lebih dari 100 karakter
			echo "<script>alert('karakter belebihan')</script>";
		} else {
			move_uploaded_file($foto, "../../Aplikasi/img/bg-img/gambar_tanaman/$nama_kategori/$nama_foto");
			$a = "../../Aplikasi/img/bg-img/gambar_tanaman/$kategori_lama/$foto_lama";
			$hapus_foto = unlink($a);
			$update = mysqli_query($conect, "UPDATE master_data SET Nama_tanaman='$nama', Stok='$stok', Harga_jual='$harga', Keterangan='$deskripsi',Gambar='$nama_foto',Id_kategori='$kategori',Kategori='$nama_kategori' WHERE Id_master_data = '$id'");
			if ($update) {
				echo "<script>alert('Data Berhasil Di Update');document.location='master_data.php'</script>";
			}
		}
	}
}
?>
<h3><span class="glyphicon glyphicon-briefcase"></span> Edit Barang</h3>
<a class="btn" href="master_data.php"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
<?php
$id_brg = $_GET['id'];
$det = mysqli_query($conect, "select * from master_data where Id_master_data='$id_brg'");
while ($d = mysqli_fetch_array($det)) {
?>
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
						<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
						<input type="hidden" name="kategori_lama" value="<?= $d['Kategori']; ?>">
						<input type="hidden" name="foto_lama" value="<?= $d['Gambar']; ?>">

						<div class="form-group row">
							<label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Nama Tanaman</label>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<input type="text" class="form-control" placeholder="Nama Tanaman" name="nama_tanaman" value="<?php echo $d['Nama_tanaman']; ?>" maxlength="100">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Kategori Tanaman Hias</label>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
								<select name="kategori" class="form-control">
									<option value="<?= $d['Id_kategori']; ?>" hidden><?= $d['Kategori']; ?></option>
									<?php $kategori = mysqli_query($conect, "select * from Kategori");
									while ($q = mysqli_fetch_array($kategori)) {
										if ($q['Id_kategori'] == $d['kategori']) {
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
						<div class="form-group row">
							<label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Deskripsi Produk</label>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<textarea name="deskripsi" class="form-control" id="editor1" rows="5" placeholder="Deskripsi Artikel"><?php echo $d['Keterangan']; ?></textarea>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Harga Tanaman</label>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
								<div class="input-group"><span class="input-group-addon">Rp.</span>
									<input type="text" class="form-control" placeholder="Harga Tanaman" name="harga" value="<?php echo $d['Harga_jual']; ?>" maxlength="100">
								</div>
							</div>
						</div>
						<diva class="form-group row">
							<label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Stok Tanaman</label>
							<div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Stok Tanaman" name="stok" value="<?php echo $d['Stok']; ?>" maxlength="100">
									<span class="input-group-addon">item</span></div>
							</div>
						</diva>
						<div class="form-group row">
							<label class="col-lg-2 col-md-3 col-sm-3 col-xs-12">Gambar Produk</label>
							<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
								<input type="file" class="form-control-file" name="foto" accept=".jpg, .png">
							</div>
						</div>
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
<?php
}
?>
<?php include 'footer.php'; ?>