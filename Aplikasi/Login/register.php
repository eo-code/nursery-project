<?php

require_once("config.php");

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $no_tlpn = filter_input(INPUT_POST,'no_tlpn', FILTER_SANITIZE_NUMBER_INT); 
    


    // menyiapkan query
    $sql = "INSERT INTO pelanggan (nama, username, email, password, no_tlpn) 
            VALUES (:nama, :username, :email, :password, :no_tlpn)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nama" => $nama,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email,
        ":no_tlpn" => $no_tlpn
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman index
    if($saved) header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Pelanggan</title>

    <link rel="stylesheet" href="../Login/css/css/bootstrap.min.css" />
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">

        <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>

        <form action="" method="POST">

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input class="form-control" type="text" name="name" placeholder="Masukan Nama Anda" />
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Masukan Username" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Masukan Alamat Email" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Masukan Password" />
            </div>
            
            
            <div class="form-group">
                <label for="password">No Telepon</label>
                <input class="form-control" type="no_tlpn" name="no_tlpn" placeholder="Masukan No telepon" />
            </div>
            
            <input type="submit" class="btn btn-success btn-block" name="register" value="Register" />

        </form>
            
        </div>

    </div>
</div>

</body>
</html>