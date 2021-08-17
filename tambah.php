<?php 

require "koneksi.php";

if (isset($_POST["submit"])) {

	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('Berhasil!');
				document.location.href = 'admin.php';
			</script>
		";
	} else {
		echo "Gagal!";
		echo "<br>";
		echo mysqli_error($koneksi);
	}

}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah</title>
</head>
<body>
	<h1>Tambah Data Mahasiswa</h1>
	<a href="admin.php">Kembali</a>
	<form action="" method="POST">
		<ul>
			
			<li>
				<!-- <label for="id_mhs">ID Mhs : </label> -->
				<input type="hidden" name="id_mhs" id="id_mhs">
			</li>
			<li>
				<label for="nim">Nim : </label>
				<input type="text" name="nim" id="nim" required>
			</li>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama">
			</li>
			<li>
				<label for="jenis_kelamin">Jenis Kelamin : </label>
				<input type="text" name="jenis_kelamin" id="jenis_kelamin">
			</li>
			<li>
				<label for="jurusan">Jurusan : </label>
				<input type="text" name="jurusan" id="jurusan">
			</li>
			<li>
				<label for="alamat">Alamat : </label>
				<input type="text" name="alamat" id="alamat">
			</li>
		</ul>
		<button type="submit" name="submit">Tambah</button>

	</form>
</body>
</html>