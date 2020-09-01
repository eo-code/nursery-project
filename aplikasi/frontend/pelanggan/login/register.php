<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../pelanggan/css/register.css">
  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../pelanggan/css/all.css">
  <title>Register</title>
</head>

<body>
  <div class="sign d-flex justify-content-center align-items-center w-100">
    <div class="container">
      <div class="box-sign w-100 d-flex">
        <div class="align-items-center justify-content-center flex-column">
        </div>
        <div class="right d-flex flex-column p-4">
          <h2 class="mb-3">Register</h2>
          <form action="back/pelanggan/signup.php" method="POST">

            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" name="nama" class="form-control">
            </div>

            <div class="form-row">
              <div class="col">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control">
              </div>
              <div class="col">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
              </div>
            </div>
            <div class="form-row mt-2">
              <div class="col">
                <label for="">No Telepon</label>
                <input type="text" name="no_hp" class="form-control">
              </div>
              <div class="col">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
              </div>
            </div>
            <p class="mt-3">Apakah anda sudah punya akun? <a href="./login.php">Login</a></p>
            <button class="mt-2" type="submit" class="btn-register">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>