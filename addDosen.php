<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Tambah Data Dosen</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap-5.1.3-dist/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
	<style>
		.utama {
			background-color: #f9f9f9;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		.form-control-ku {
			display: inline-block;
			width: auto;
			margin-right: 10px;
		}
		h3 {
			margin-bottom: 20px;
		}
		.alert-success {
			margin-top: 10px;
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
			<h3><i class="bi bi-person-plus"></i> Tambah Data Dosen</h3>
			<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
		  		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
			</div>	
			<form id="faddDosen">
				<div class="form-group mb-3">
					<label for="npp2">NPP:</label>
					<div class="input-group">
						<input class="form-control-ku col-md-2" type="text" name="npp1" id="npp1" value="0686.11" readonly>
						<select class="form-control-ku col-md-2" name="npp2" id="npp2">
							<?php
							for($th=1990;$th<=2020;$th++){
								echo "<option value=$th>$th";
							}
							?>					
						</select>
						<input type="text" class="form-control-ku col-md-2" name="npp3" id="npp3">
					</div>
				</div>
				<div class="form-group mb-3">
					<label for="nama">Nama Dosen:</label>
					<input class="form-control" type="text" name="nama" id="nama">
				</div>
				<div class="form-group mb-3">
					<label for="homebase">Homebase:</label>
					<select class="form-control" name="homebase" id="homebase">
						<?php
						$arrhobe=array('A11','A12','A14','A15','A16','A17','A22','A24','P31');
						foreach($arrhobe as $hb){
							echo "<option value=$hb>$hb";
						}
						?>					
					</select>
				</div>
				<div class="d-grid gap-2">
					<button class="btn btn-primary" type="button" name="tombsimpan" id="tombsimpan"><i class="bi bi-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
	<footer>
		&copy; A12.2022.06776 (Muhamad Risqi Faiz)
	</footer>
	<script>
	$(document).ready(function(){
		$("#tombsimpan").on('click', function(){
			var npp1 = $("#npp1").val();
			var npp2 = $("#npp2").val();
			var npp3 = $("#npp3").val();
			var nama = $("#nama").val();
			var homebase = $("#homebase").val();
			$.ajax({
				type	: "post",
				url 	: "sv_addDosen.php",
				data 	: {
					npp1	: npp1,
					npp2 	: npp2,
					npp3	: npp3,
					nama 	: nama,
					homebase: homebase
				},
				success : function(data){
					$("#npp1").val('');
					$('#npp2').val('');
					$("#npp3").val('');
					$('#nama').val('');
					$('#homebase').val('');
					$('#success').show();
					$('#success').html(data);
				}
			});
		});
	});
	</script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css"></script>
</body>
</html>
