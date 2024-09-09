<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Tambah Data Mahasiswa</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/styleku.css">
	<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<script src="bootstrap-5.1.3-dist/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
	<style>
		.utama {
			background-color: #f9f9f9;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin-bottom: 80px; /* Tambahkan margin bawah untuk memberi ruang bagi footer */
		}
		footer {
			position: fixed;
			bottom: 0;
			width: 100%;
			background-color: #f1f1f1;
			text-align: center;
			padding: 10px;
			font-size: 14px;
			color: #555;
			box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body>
	<?php
		require "head.html";
	?>
	<div class="container mt-5">
		<div class="utama">		
			<br><br><br>		
			<h3>TAMBAH DATA MAHASISWA</h3>
			<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			</div>	
			<form method="post" action="sv_addMhs.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="nim">NIM:</label>
					<input class="form-control" type="text" name="nim" id="nim" required>
				</div>
				<div class="form-group">
					<label for="nama">Nama:</label>
					<input class="form-control" type="text" name="nama" id="nama">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input class="form-control" type="email" name="email" id="email">
				</div>
				<div class="form-group">
					<label for="foto">Foto</label> 
					<input class="form-control" type="file" name="foto" id="foto">
				</div>
				<div>		
					<button type="submit" class="btn btn-primary" value="Simpan">Simpan</button>
				</div>
			</form>
		</div>
	</div>
	<footer>
		&copy; A12.2022.06776(Muhamad Risqi Faiz)
	</footer>
</body>
</html>
