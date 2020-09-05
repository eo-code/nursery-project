<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang Terjual</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<?php 
			$pil=mysql_query("select distinct tanggal from barang_laku order by tanggal desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['tanggal'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>

</form>
<br/>
<?php 
if(isset($_GET['tanggal'])){
	$tanggal=mysql_real_escape_string($_GET['tanggal']);
	$tg="lap_barang_laku.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_laku.php";
}
?>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<table class="table">
	<tr>
        <th>No</th>
        <th>Tanggal</th>
		<th>Nama Pelanggan</th>
		<th>Alamat</th>
		<th>No.Hp</th>
		<th>Nama Tanaman Hias</th>
		<th>Qty</th>			
		<th>Harga</th>			
		<th>Opsi Pengiriman</th>
	</tr>
	<?php 
	if(isset($_GET['tanggal'])){
		$tanggal=mysql_real_escape_string($_GET['tanggal']);
		$b=mysql_query("select * from barang_laku where id like '$id' order by id desc");
	}else{
		$master_data=mysql_query("select * from barang_laku order by id desc");
	}
	$no=1;
	while($master_data=mysql_fetch_array($master_data)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama_pelanggan'] ?></td>
            <td><?php echo $b['alamat'] ?></td>
            <td><?php echo $b['no_tlpn'] ?></td>
            <td><?php echo $b['nama_tanamanhias'] ?></td>
            <td><?php echo $b['qty'] ?></td>
            <td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
            <td><?php echo $b['opsi_pengiriman'] ?></td>
			<td>		
				<a href="edit_laku.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_laku.php?id=<?php echo $b['id']; ?>&harga=<?php echo $b['harga'] ?>&id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>

		<?php 
	}
	?>

</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Penjualan
				</div>
				<div class="modal-body">				
					<form action="barang_laku_act.php" method="post">
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tanggal" type="date" class="form-control" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Nama Pelanggan</label>								
							<input name="namapelanggan" type="text" class="form-control" autocomplete="off">

						</div>									
					
                        <div class="form-group">
							<label>Alamat</label>								
							<input name="alamat" type="text" class="form-control" autocomplete="off">

						</div>	
                        
                        <div class="form-group">
							<label>No Tlpn</label>								
							<input name="notlpn" type="text" class="form-control" autocomplete="off">
						</div>	
                        
                        <div class="form-group">
							<label>Nama Tanaman Hias</label>								
						<input name="namatanamanhias" type="text" class="form-control" autocomplete="off">
						</div>
                        
                        <div class="form-group">
							<label>QTY</label>								
					       <input name="qty" type="text" class="form-control" autocomplete="off">
						</div>
                        
                        <div class="form-group">
							<label>Harga</label>								
							<input name="harga" type="text" class="form-control" autocomplete="off">
						</div>
                        
                          <div class="form-group">
							<label>Opsi Pengiriman</label>								
							<select class="form-control" name="opsipengiriman">
                                <option value="">Pilih:</option>
                                <option value="cod">COD</option>
                                <option value="pembayaranditoko">Pembacaran Di Toko</option>
								<?php 
								$b=mysql_query("select * from master_data");
								while($b=mysql_fetch_array($b)){
									?>	
									<option value="<?php echo $b['cod']; ?>"><?php echo $b['pembayaranditoko'] ?></option>
									<?php 
								}
								?>
							</select>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>