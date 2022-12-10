<?php include 'config/class.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Kelompok Tani Hutan Ngudi Rejeki</title>
	<link rel="stylesheet" type="text/css" href="aplikasi/css/bootstrap.css"> 
	<link rel="stylesheet" type="text/css" href="aplikasi/css/loginn.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
	<div class="login">

		<div class="avatar">
			<i class="fa fa-user"></i>
		</div>

		<h2>Login</h2>
		<form method="post">
			<div class="box-login">
				<i class="fas fa-envelope-open-text"></i> &nbsp;
				<input type="text" name="un" placeholder="  Username" autocomplete="off">
			</div>

			<div class="box-login">
				<i class="fas fa-lock"></i>
				<input type="password" name="ps" placeholder="  Password" autocomplete="off">
			</div>
			<div>
				<input type="submit" name="login" value="Login" class='btn btn-primary center-block'>
			</div>
		</form>
						<?php 
									// jika ada tombol login, maka
						if (isset($_POST['login'])) 
						{
										//objek admin mengakses fungsi login admin (akun dr form)
							$hasil= $admin->login_admin($_POST['un'],$_POST['ps']);
										 // jika hasil sukses,maka masuk index
							if ($hasil=="sukses") 
							{
								echo "<div class='alert alert-info'>Login Sukses</div>";
								echo "<meta http-equiv='refresh' content='1;url=aplikasi/index.php'>";
							}
										  // selain itu gagal
							else
							{
								echo "<div class='alert alert-danger'>Login Gagal</div>";
								echo "<meta http-equiv='refresh' content='1;url=index.php'>";
							}
						}

						?>
	</body>
	</html>