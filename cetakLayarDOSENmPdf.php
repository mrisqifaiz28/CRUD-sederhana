<?php 

	include "fungsi.php";

	$data = mysqli_query($koneksi, "SELECT * FROM dosen");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Daftar Dosen</title>
	<style type="text/css">
		td{
			padding: 3px 3px;
		}
	</style>
</head>
<body>
<h3 align="center">Data Dosen</h3>
<table style="border-collapse:collapse;border-spacing:0;" align="center" border="1">
	<thead>
		<tr>
			<th>No.</th>
			<th>NPP</th>
			<th>Nama</th>
			<th>HomeBase</th>
			
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
			<td><?php echo $row["namadosen"]?></td>
			<td><?php echo $row["homebase"]?></td>
		</tr>
	<?php	
	}
	?>

	</tbody>
</table>
<br>
<div align="center"><a href="cetakPrinterDOSENmPdf.php" target="_blank"><button>Cetak PDF</button></a></div>
</body>
</html>