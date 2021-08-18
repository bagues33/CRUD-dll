<?php 

require "koneksi.php";

$id = $_GET["id_mhs"];

$mhs = query("SELECT * FROM mahasiswa WHERE id_mhs = $id")[0];

if (isset($_POST["submit"])) {

	if (ubah($_POST) > 0) {
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
	<title>Ubah</title>
</head>
<body>
	<h1>Ubah Data Mahasiswa</h1>
	<a href="admin.php">Kembali</a>
	<form action="" method="POST" enctype="multipart/form-data">
		<ul>
			
			<li>
				<!-- <label for="id_mhs">ID Mhs : </label> -->
				<input type="hidden" name="id_mhs" id="id_mhs" value="<?php echo $mhs["id_mhs"] ?>">
				<input type="hidden" name="gambarLama"  value="<?php echo $mhs["gambar"] ?>">
			</li>
			<li>
				<label for="nim">Nim : </label>
				<input type="text" name="nim" id="nim" value="<?php echo $mhs["nim"] ?>" required>
			</li>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" value="<?php echo $mhs["nama"] ?>">
			</li>
			<li>
				<label for="jenis_kelamin">Jenis Kelamin : </label>
				<input type="text" name="jenis_kelamin" id="jenis_kelamin" value="<?php echo $mhs["jenis_kelamin"] ?>">
			</li>
			<li>
				<label for="jurusan">Jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" value="<?php echo $mhs["jurusan"] ?>">
			</li>
			<li>
				<label for="alamat">Alamat : </label>
				<input type="text" name="alamat" id="alamat" value="<?php echo $mhs["alamat"] ?>">
			</li>
			<li>
				<label for="gambar">Gambar : </label> <br>
				<img src="img/<?php echo $mhs["gambar"] ?>" width="70px"> <br>
				<input type="file" name="gambar" id="gambar" >
			</li>
		</ul>
		<button type="submit" name="submit">Ubah</button>

	</form>
</body>
</html>