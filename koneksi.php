<?php 

$koneksi = mysqli_connect("localhost","root","","db_mhs");


function query($query) {
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah($data) {

	global $koneksi;

	$id_mhs = htmlspecialchars($data["id_mhs"]);
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$alamat = htmlspecialchars($data["alamat"]);


	$query = "INSERT INTO mahasiswa VALUES
					('$nim','','$nama','$jenis_kelamin','$jurusan','$alamat')";

	mysqli_query($koneksi, "$query");

	return mysqli_affected_rows($koneksi);
}

function hapus($id) {
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs = $id");

	return mysqli_affected_rows($koneksi);
}

function ubah($data) {

	global $koneksi;

	$id_mhs = htmlspecialchars($data["id_mhs"]);
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$alamat = htmlspecialchars($data["alamat"]);


	$query = "UPDATE mahasiswa SET 
				id_mhs = '$id_mhs',
				nim = '$nim',
				nama = '$nama',
				jenis_kelamin = '$jenis_kelamin',
				jurusan = 'jurusan',
				alamat = '$alamat'
				WHERE id_mhs = $id_mhs
		";

	mysqli_query($koneksi, "$query");

	return mysqli_affected_rows($koneksi);
}


 ?>