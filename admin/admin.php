<?php 

session_start();

if( !isset($_SESSION["login"]) ) {

	header("location: login.php");
	exit;
}

require "koneksi.php";
	
//pagination
//konfigurasi
$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;
// if(isset($_GET["halaman"])) {		
// 	$halamanAktif = $_GET["halaman"];
// } else {
// 	$halamanAktif = 1;
// }

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman ");

// $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id_mhs DESC");

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
	<a href="logout.php">Logout!</a>
	<h1>Daftar Mahasiswa</h1>
	<a href="tambah.php">Tambah</a>
	<br>
	<br>
	<form action="" method="POST">
		<input type="text" name="keyword" autofocus placeholder="Masukkan keyword pencarian" size="30" autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari</button>
	</form> <br>

<!--navigasi  -->
<?php if($halamanAktif > 1) { ?>
	<a href="?halaman=<?php echo $halamanAktif - 1 ?>">&lt;</a>
<?php } ?>
	<?php for($i = 1; $i <= $jumlahHalaman; $i++) { ?>
		<?php if($i == $halamanAktif) { ?>
			<a href="?halaman=<?php echo $i ?>" style="font-size: 20px; color: red;"><?php echo $i ?></a>
			<?php } else { ?>
			<a href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
		<?php } ?>
	<?php } ?>
<?php if($halamanAktif < $jumlahHalaman) { ?>
	<a href="?halaman=<?php echo $halamanAktif + 1 ?>">&gt;</a>
<?php } ?>

<div id="container">
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
</div>
<script src="script.js"></script>
</body>
</html>