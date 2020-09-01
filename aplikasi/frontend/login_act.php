<?php 
session_start();
include 'admin/config.php';
$username= $_POST['username'];
$pass= $_POST['pass'];
$pass= md5($pass);
$query= mysql_query("select * from admin where username='$username' and pass='$pass'")or die(mysql_error());
if(mysql_num_rows($query)==1){
	$_SESSION['username']=$username;
	header("location:admin/index.php");
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}
// echo $pas;
 ?>