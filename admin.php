<?php 

require "koneksi.php";

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id_mhs DESC");

// while ( $mhs = mysqli_fetch_assoc($result)) {

// var_dump($mhs);

// };
//tombol cari diinput
if( isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body>
	<h1>Daftar Mahasiswa</h1>
	<a href="tambah.php">Tambah</a>
	<br>
	<br>
	<form action="" method="POST">
		<input type="text" name="keyword" autofocus placeholder="Masukkan keyword pencarian" size="30" autocomplete="off">
		<button type="submit" name="cari">Cari</button>
	</form>
	<table border="1" cellspacing="2" cellpadding="5">
		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Nim</th>
			<th>NRP</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Jurusan</th>
			<th>Alamat</th>
			<th>Gambar</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($mahasiswa as $row) { ?>
			 
		<tr>
			<td><?php echo $i; ?></td>
			<td><a href="ubah.php?id_mhs=<?php echo $row["id_mhs"]; ?>">Ubah</a> | <a href="hapus.php?id_mhs=<?php echo $row["id_mhs"]; ?>" onclick="return confirm('Yakin?')">Hapus</a></td>
			<td><?php echo $row["nim"]; ?></td>
			<td><?php echo $row["id_mhs"]; ?></td>
			<td><?php echo $row["nama"]; ?></td>
			<td><?php echo $row["jenis_kelamin"]; ?></td>
			<td><?php echo $row["jurusan"]; ?></td>
			<td><?php echo $row["alamat"]; ?></td>
			<td><img src="img/<?php echo $row["gambar"]; ?>" width="100px"></td>
		</tr>
		<?php $i++; ?>
		<?php } ?>
	</table>
</body>
</html>