<?php
session_start();
include 'admin/config.php';
$username = $_POST['username'];
$pass = $_POST['pass'];
$pass = md5($pass);
$query = mysqli_query($conect, "select * from admin where username='$username' and pass='$pass'") or die(mysqli_error());
if (mysqli_num_rows($query) == 1) {
	$_SESSION['username'] = $username;
	header("location:admin/index.php");
} else {
	header("location:index.php?pesan=gagal") or die(mysqli_error());
	// mysql_error();
}
// echo $pas;
