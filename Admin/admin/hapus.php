<?php 
include 'config.php';
$id=$_GET['id_master_data'];
mysql_query("delete from master_data where id_master_data='$id'");
header("location:master_data.php");

?>