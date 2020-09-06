<?php
include 'config.php';
$id = $_GET['id'];
//ambil gambar untuk di hapus
$ambil = mysqli_query($conect, "SELECT Gambar, Kategori From master_data");
$d = mysqli_fetch_array($ambil);
$kategori = $d['Kategori'];
$gambar = $d['Gambar'];
$a = "../../Aplikasi/img/bg-img/gambar_tanaman/$kategori /$gambar";
$hapus_foto = unlink($a);
mysqli_query($conect, "delete from master_data where Id_master_data='$id'");
header("location:master_data.php");
