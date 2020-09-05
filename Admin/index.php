<!DOCTYPE html>
<html>
<head>
	<title>Aneka Indah Nursery</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.js"></script>
	<?php include 'admin/config.php'; ?>
	<style type="text/css">
    body{
        margin-bottom:0px;
	    padding:0px;
        background: url(Gambar/background3.jpg);
        background-size: cover;
	    background-position: center;
	    font-family:Tahoma, Geneva, sans-serif;
	    height: 100vh;
        } 
    h3{
        text-align: center;
        color: coral;
        }

        
	.kotak{	
        width: 400px;
        height: 300px;
        background-color: bisque;
        top: 50%;
        left: 18%;
        position: absolute;
        box-sizing:border-box;
        transform: translate(-50%,-50%);
        border: 2px solid rgba(0,0,0,0.5);
        border-color: black;
	}

	.kotak .input-group{
        margin-top: 45px;
		margin-bottom: -20px;
	}
	</style>
</head>
<body>	
	<div class="container">
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo
                    "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username dan Password Salah !!</div>";
			}
		}
		?>
		<div class="panel panel-default">
			<form action="login_act.php" method="post">
				<div class="col-md-4 col-md-offset-4 kotak">
                    <h3>Login Admin</h3>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="Username" name="username">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" name="pass">
					</div>
					<div class="input-group">			
						<input type="submit" class="btn btn-primary" value="Login">
					</div>
                      
				</div>
			</form>
		</div>
	</div>
</body>
</html>