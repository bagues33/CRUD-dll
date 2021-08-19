<?php 

// session_start();

// if( !isset($_SESSION["login"]) ) {

// 	header("location: login.php");
// 	exit;
// }

require 'koneksi.php';

if (isset($_POST["register"])) {

	if(registrasi($_POST) > 0) {
		echo "<script>
				alert('User baru berhasil ditambahkan');
				 window.location='login.php';
			</script>";

	} else {
		echo mysqli_error($koneksi);
	}

	
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>

	<h1>Halaman Register</h1>
	<form action="" method="POST">
		<ul>
			<li>
				<label for="username">Username : </label>
				<input type="text" name="username" id="username" required>
			</li>
			<li>
				<label for="password">Password : </label>
				<input type="password" name="password" id="password" required>
			</li>
			<li>
				<label for="password2">Konfirmasi password : </label>
				<input type="password" name="password2" id="password2" required>
			</li> <br>
			<button type="submit" name="register">Daftar</button>
		</ul>
	</form>

</body>
</html>