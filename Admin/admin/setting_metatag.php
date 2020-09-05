<?php
//session dimulai
session_start();
//abaikan error pada browser
error_reporting(0);
//panggil file koneksi untuk mengkoneksinkan dengan database
include "Admin/admin/assets/relasi/koneksi.php";
//panggil file security untuk mengecek session admin
include "security.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="<?php echo $iweb['katakunci'];?>">
        <meta name="description" content="<?php echo $iweb['deskripsi'];?>" />
        <meta name="author" content="<?php echo $iweb['pembuat'];?>">
        <title><?php echo $iweb['nama_website'];?></title>
        <link rel="Shortcut Icon" href="<?php echo $hostname;?>/assets/images/logo/<?php echo $iweb['logo'];?>" type="image/x-icon" />
        <!-- Bootstrap core CSS -->
        <link href="<?php echo $hostname;?>/assets/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles template ini-->
        <link href="<?php echo $hostname;?>/assets/css/style_admin.css" rel="stylesheet">

        <!-- Custom Fonts Awesome-->
        <link href="<?php echo $hostname;?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">