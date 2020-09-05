<?php 
include 'config.php';
$id_master_data=$_GET['id_master_data'];
$nama_tanaman=$_GET['nama_tanaman'];
$stok=$_GET['stok'];
$harga=$_GET['harga'];
$qty=$_GET['qty'];
$kategori=$_GET['kategori'];
$keterangan=$_GET['keterangan'];
$gambar=$_GET['gambar'];

$a=mysql_query("select jumlah from master_data where nama_tanaman='$nama'");
$b=mysql_fetch_array($a);
$kembalikan=$b['jumlah']+$jumlah;
$c=mysql_query("update master_data set jumlah='$kembalikan' where nama_tanaman='$nama'");
mysql_query("delete from barang_laku where id_master_data='$id'");
header("location:barang_laku.php");

 ?>