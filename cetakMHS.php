<!DOCTYPE html>
<html>
<head>
	 <title>Laporan</title>
</head>
<body>
			<style type="text/css">
						body{
						font-family: sans-serif;
						}
						table{
						margin: 20px auto;
						border-collapse: collapse;
						}
						table th,
						table td{
						border: 1px solid #3c3c3c;
						padding: 3px 8px;

						}
						a{
						background: blue;
						color: #fff;
						padding: 8px 10px;
						text-decoration: none;
						border-radius: 2px;
						}

							.tengah{
								text-align: center;
							}
			</style>
	<table>
	<tr>
	<th>No</th>
	<th>N I M</th>
	<th>Nama</th>
	<th>email</th>
	</tr>
	<?php 
	// koneksi  database
	$koneksi = mysqli_connect("localhost","root","","pwlgenap2019-akademik");

	// menampilkan data pegawai
	$data = mysqli_query($koneksi,"select * from mhs");
	while($d = mysqli_fetch_array($data)){
	?>
	<tr>
	<td style='text-align: center;'><?php echo $d['id'] ?></td>
	<td><?php echo $d['nim']; ?></td>
	<td><?php echo $d['nama']; ?></td>
	<td><?php echo $d['email']; ?></td>
	
	</tr>
	<?php 
	}
	?>
		</table>
		<script>
	window.print();
	</script>
</body>
</html>