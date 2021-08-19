<?php 

session_start();

if( !isset($_SESSION["login"]) ) {

	header("location: login.php");
	exit;
}

require "koneksi.php";

$id = $_GET["id_mhs"];

if (hapus($id) > 0 ) {
	echo "

		<script>
			alert('Berhasil!');
			document.location.href = 'admin.php';
		</script>

	";
} else {
	echo "

		<script>
			alert('Gagal!');
		</script>

	";
}

 ?>