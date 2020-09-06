<!DOCTYPE html>
<html>

<head>
	<?php
	session_start();
	include 'cek.php';
	include 'config.php';
	?>
	<title>Aneka Indah Nursery</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
</head>

<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">


				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<!-- <div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php
					$periksa = mysqli_query($conect, "select * from master_data");
					while ($q = mysqli_fetch_array($periksa)) {

						echo $q['Nama_tanaman'];
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>

			</div>
		</div>
	</div> -->

	<div class="col-md-2">
		<div class="row">


		</div>

		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
			<li><a href="master_data.php"><span class="glyphicon glyphicon-briefcase"></span> Data Barang</a></li>
			<li><a href="barang_laku.php"><span class="glyphicon glyphicon-briefcase"></span>Penjualan</a></li>
			<li><a href=""><span class="glyphicon glyphicon-briefcase"></span>Kategori</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
	<div class="col-md-10">