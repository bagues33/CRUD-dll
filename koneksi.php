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

	//upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}


	$query = "INSERT INTO mahasiswa VALUES
					('$nim','','$nama','$jenis_kelamin','$jurusan','$alamat','$gambar')";

	mysqli_query($koneksi, "$query");

	return mysqli_affected_rows($koneksi);
}

function upload() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//cek apakah tidak ada gambar yanga diupload
	if ($error === 4) {
		echo "<script>alert('pilih gambar terlebih dahulu!')</script>";
		return false;
	}

	//cek apakah yang diupload gambar
	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));


	if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>alert('yang diupload bukan gambar!')</script>";
		return false;
	} 

	if($ukuranFile > 1000000) {
		echo "<script>alert('Ukuran gambar terlalu besar!')</script>";
		return false;
	}

	//generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	
	//lolos pengecekan gambar, siap di upload
	move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

	return $namaFile;
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
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//cek apakah user memilih gambar baru atau lama
	if($_FILES["gambar"]["error"] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$gambar = htmlspecialchars($data["gambar"]);


	$query = "UPDATE mahasiswa SET 
				id_mhs = '$id_mhs',
				nim = '$nim',
				nama = '$nama',
				jenis_kelamin = '$jenis_kelamin',
				jurusan = 'jurusan',
				alamat = '$alamat',
				gambar = '$gambar'
				WHERE id_mhs = $id_mhs
		";

	mysqli_query($koneksi, "$query");

	return mysqli_affected_rows($koneksi);
}


function cari($keyword) {
	$query = "SELECT * FROM mahasiswa 
				WHERE 
				nama LIKE '%$keyword%' OR 
				nim LIKE '%$keyword%' OR
				jurusan LIKE '%$keyword%'

				";
				return query($query);
}


function registrasi($data) {
	global $koneksi;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

	//cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)) {
		echo "<script>alert('Username sudah ada!');</script>";
		return false;
	}

	if($password !== $password2) {

		echo "<script>alert('Konformasi password tidak sesuai!');</script>";

		return false;
	}

	//enskripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES('','$username','$password')");

	return mysqli_affected_rows($koneksi);	

}

 ?>