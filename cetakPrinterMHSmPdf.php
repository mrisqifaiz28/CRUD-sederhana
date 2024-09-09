<?php 

	include "fungsi.php";

	$data = mysqli_query($koneksi, "SELECT * FROM mhs");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Daftar Mahasiswa</title>
	<style type="text/css">
		td{
			padding: 3px 3px;
		}
	</style>
</head>
<body>

<h3 align="center">Data Mahasiswa</h3>
<table style="border-collapse:collapse;border-spacing:0;" align="center" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>email</th>
			<th>Foto</th>
			
		</tr>
	</thead>
	<tbody>
	<?php 
	$no=0;
		while ($row = mysqli_fetch_assoc($data)) {
		$no++;
	?>	
		<tr>
			<td><?php echo $no?></td>
			<td><?php echo $row["nim"]?></td>
			<td><?php echo $row["nama"]?></td>
			<td><?php echo $row["email"]?></td>
			<td><img src="<?php echo "foto/".$row["foto"]?>" height="50"></td>
		</tr>
	<?php	
	}
	?>

	</tbody>
</table>
<br>

</body>
</html>

<?php 

	//Meload library mPDF
	require 'vendor/composer/autoload_files.php';

	//Membuat inisialisasi objek mPDF
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','margin_top' => 25, 'margin_bottom' => 25, 'margin_left' => 25, 'margin_right' => 25]);

	//Memasukkan output yang diambil dari output buffering ke variabel html
	$html = ob_get_contents();

	//Menghapus isi output buffering
	ob_end_clean();

	$mpdf->WriteHTML(utf8_encode($html));

	//Membuat output file
	$content = $mpdf->Output("daftar mahasiswa.pdf", "D");

?>