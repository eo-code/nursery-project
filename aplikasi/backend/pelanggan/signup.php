<?php
// include file config.php
include "admin/config.php";

// Variable dari form user
$username = $_POST["username"];
$password = $_POST["password"];
$nama = $_POST["nama"];
// $alamat = $_POST["alamat"];
$no_hp = $_POST["no_hp"];
$email = $_POST["email"];

// validasi password dan email
$validEmail = preg_match("/^\S+@\S+\.\S+$/", $email);
$validPassword = strlen(trim($password));

$cekEmail = mysqli_query($koneksi, "SELECT email FROM `member` where email = '$email' ");
if ($cekEmail->num_rows !== 0) {
    echo "<script>window.location.href = 'aplikasi/back/pelanggan/signup.php?kodeError=2' </script>";
}

// Jika email tersedia
else {


    // Check validasi
    if ($validEmail < 0 || $validPassword < 6) {
        // Redirect ke halaman signup jika gagal
        echo "<script>window.location.href = 'aplikasi/back/pelanggan/signup.php?kodeError=6' </script>";
    } else {
        // hash password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // process menyimpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO member (username, `password`, nama, email, no_hp) VAlUES ('$username', '$hashPassword', '$nama', '$email', '$no_hp') ");

        if ($simpan) {
            // Redirect ke halaman login
            echo "<script>window.location.href = 'aplikasi/front/pelanggan/login/register.php' </script>";
        } else {
            // Redirect ke halaman signup
            echo "<script>window.location.href = 'aplikasi/front/pelanggan/login/register.php?kodeError=0' </script>";
        }
    }
}
// kodeError
// 2 = email sudah terdaftar
// 0 = bad request
