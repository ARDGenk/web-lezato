<?php
	session_start();
    require '../config/constants.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Food Order System</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center"><br><br>Login</h1>
		<br><br>

			<?php
			
				if(isset($_SESSION['login']))
				{
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}

				if(isset($_SESSION['no-login-message']))
				{
					echo $_SESSION['no-login-message'];
					unset($_SESSION['no-login-message']);
				}
				
			 ?>
			 <br><br>

			<!-- Form -->
			<form action="" method="POST" class="text-center">
				Username:
				<input type="text" name="username" placeholder="Enter Username">
				<br><br>
				Password:
				<input type="password" name="password" placeholder="Enter Password">
				<br><br>

				<input type="submit" name="submit" value="login" class="btn-primary">
			</form>
			<!-- End Form -->
			<p class="text-center">Create by - <a href="#">Ardiansyah</a> </p>
	</div>
</body>
</html>

<?php 
	if(isset($_POST['submit']))
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		// SQL
		$cursor = $db->col_admin->findOne([
			'username' => $username,
			'password' => $password
		]);

		if($cursor){
			$_SESSION['login'] = "<div class='success text-center'>Login Berhasil</div>";
			$_SESSION['user'] = $username;
			header('location: ./../admin/');
		}else{
			$_SESSION['login'] = "<div class='error text-center'>Username atau Password yang anda masukan salah</div>";
			header('location: ./login.php');
		}
	}
?>