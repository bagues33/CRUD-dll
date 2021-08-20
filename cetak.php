<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'koneksi.php';
$mahasiswa = query("SELECT * FROM mahasiswa"); 

$mpdf = new \Mpdf\Mpdf();

$html = '>
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
		</head>
		<body>
			<h1>Hello World!</h1>
			<table border="1" cellspacing="2" cellpadding="5"> 
		<tr>
			<th>No.</th>
			<th>Nim</th>
			<th>NRP</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Jurusan</th>
			<th>Alamat</th>
			<th>Gambar</th>
		</tr>';
		
		$i = 1;
		foreach ($mahasiswa as $row) {
			$html .= '<tr>
						<td>'. $i++ .'</td>
						<td>'. $row["nim"] .'</td>
						<td>'. $row["id_mhs"] .'</td>
						<td>'. $row["nama"] .'</td>
						<td>'. $row["jenis_kelamin"] .'</td>
						<td>'. $row["jurusan"] .'</td>
						<td>'. $row["alamat"] .'</td>
						<td><img src="img/'. $row["gambar"] .'" width="100px"></td>
					</tr>';
		}

	$html .= '</table>
		</body>
		</html>
		';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);

?>

