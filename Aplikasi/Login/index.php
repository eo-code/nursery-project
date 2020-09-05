<?php 
include 'config.php'; // panggil perintah koneksi database 

if(!isset($_SESSION['username'] )== 0) { // cek session apakah kosong(belum login) maka alihkan ke index.php
    header('Location:../index2.php');
}

if(isset($_POST['login'])) { // mengecek apakah form variabelnya ada isinya
    $username = $_POST['username']; // isi varibel dengan mengambil data username pada form
    $password = $_POST['password']; // isi variabel dengan mengambil data password pada form

    try {
        $sql = "SELECT * FROM pelanggan WHERE username = :username AND password = :password"; // buat queri select
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute(); // jalankan query

        $count = $stmt->rowCount(); // mengecek row
        if($count == 1) { // jika rownya ada 
            $_SESSION['username'] = $username; // set sesion dengan variabel username
            header("Location:../index2.php"); // lempar variabel ke tampilan index.php
            return;
        }else{
            header("location: index.php?pesan=gagal");
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Pelanggan</title>
<link rel="stylesheet" type="text/css" href="../Login/css/css-login.css">
</head>

<body>
    <?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo
                    "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username dan Password Salah !!</div>";
			}
		}
		?>

		<div class="panel panel-default">
			<form action="" method="post">
                <div class="text">
                    <h1>SILAHKAN LOGIN</h1>
                </div>

                <div class="login-box1">
	               <h1>LOGIN HERE</h1>
                    <p>Username</p>
                    <input type="text" name="username" placeholder="Masukkan username" />
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Masukkan password" />
                    <input type="submit" name="login" value="Login" />
                    <div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
                    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
                        </div>
            </form>
                </div>
<div class="login-box2">
    </div>
</body>
</html>
