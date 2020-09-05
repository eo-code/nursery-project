<?php 
include 'config.php';
$id=$_POST['id'];
$tanggal=$_POST['tanggal'];
$nama_pelanggan=$_POST['nama_pelanggan'];
$alamat=$_POST['alamat'];
$no_tlpn=$_POST['no_tlpn'];
$nama_tanamanhias=$_POST['nama_tanamanhias'];
$qty=$_POST['qty'];
$harga=$_POST['harga'];
$opsi_pengiriman=$_POST['opsi_pengiriman'];

$dt=mysql_query("select * from master_data where id='$id'");
$dt=mysql_query("update master_data set id='$id' where id='$id'");

$dt=mysql_query("insert into barang_laku values('','$id','$tanggal','$nama_pelanggan','$alamat','$no_tlpn','$nama_tanamanhias','$qty','$harga','$opsi_pengiriman')")or die(mysql_error());
header("location:barang_laku.php");

?>