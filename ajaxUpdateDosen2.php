<!DOCTYPE html>
<html>

<head>
	<title>Sistem Informasi Akademik::Daftar Dosen</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styleku.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<style>
		.utama {
			background-color: #f9f9f9;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin-bottom: 80px;
			margin-top: 20px;
		}

		.pagination .page-link {
			color: #007bff;
		}

		.pagination .page-link:hover {
			color: #0056b3;
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

		.btn-outline-success {
			color: green;
			background-color: white;
			border-color: green;
		}

		.btn-outline-success:hover,
		.btn-outline-success:focus,
		.btn-outline-success:active {
			color: green;
			background-color: green;
			border-color: green;
		}
	</style>
</head>

<body>
	<?php
	require "fungsi.php";
	require "head.html";

	$jmlDataPerHal = 5;

	if (isset($_POST['cari'])) {
		$cari = $_POST['cari'];
		$sql = "select * from dosen where npp like'%$cari%' or
					namadosen like '%$cari%' or
					homebase like '%$cari%'";
	} else {
		$sql = "select * from dosen";
	}

	$qry = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
	$jmlData = mysqli_num_rows($qry);
	$jmlHal = ceil($jmlData / $jmlDataPerHal);

	if (isset($_GET['hal'])) {
		$halAktif = $_GET['hal'];
	} else {
		$halAktif = 1;
	}

	$awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;
	$kosong = !$jmlData;

	if (isset($_POST['cari'])) {
		$cari = $_POST['cari'];
		$sql = "select * from dosen where npp like'%$cari%' or
					namadosen like '%$cari%' or
					homebase like '%$cari%'
					limit $awalData, $jmlDataPerHal";
	} else {
		$sql = "select * from dosen limit $awalData, $jmlDataPerHal";
	}

	$hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
	?>
	<div class="container mt-5">
		<div class="utama">
			<h2 class="text-center">Daftar Dosen</h2>
			<center>
				<a href="cetakDOSEN.php" class="btn btn-primary"><span class="fas fa-print"></span> Print</a>
			</center>

			<div class="d-flex justify-content-between mb-3">
				<a class="btn btn-success" href="addDosen.php">Tambah Data</a>
				<form class="d-flex" action="" method="POST">
					<input class="form-control me-2" type="search" placeholder="Cari data dosen..." name="cari">
					<button class="btn btn-outline-success" style="background-color:white;" type="submit">Cari</button>
				</form>
			</div>
			<ul class="pagination justify-content-center">
				<?php
				if ($halAktif > 1) {
					$back = $halAktif - 1;
					echo "<li class='page-item'><a class='page-link' href=?hal=$back>&laquo;</a></li>";
				}
				for ($i = 1; $i <= $jmlHal; $i++) {
					if ($i == $halAktif) {
						echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:red;'>$i</a></li>";
					} else {
						echo "<li class='page-item'><a class='page-link' href=?hal=$i>$i</a></li>";
					}
				}
				if ($halAktif < $jmlHal) {
					$forward = $halAktif + 1;
					echo "<li class='page-item'><a class='page-link' href=?hal=$forward>&raquo;</a></li>";
				}
				?>
			</ul>
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>No.</th>
						<th>NPP</th>
						<th>Nama</th>
						<th>HomeBase</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($kosong) {
					?>
						<tr>
							<th colspan="6">
								<div class="alert alert-info alert-dismissible fade show text-center">
									Data tidak ada
								</div>
							</th>
						</tr>
						<?php
					} else {
						$no = $awalData + 1;
						while ($row = mysqli_fetch_assoc($hasil)) {
						?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $row["npp"] ?></td>
								<td><?php echo $row["namadosen"] ?></td>
								<td><?php echo $row["homebase"] ?></td>
								<td>
									<a class="btn btn-outline-primary btn-sm" href="editDosen.php?kode=<?php echo $row['npp'] ?>">Edit</a>
									<a class="btn btn-outline-danger btn-sm" href="hpsDosen.php?kode=<?php echo $row["npp"] ?>" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
								</td>
							</tr>
					<?php
							$no++;
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

</body>
<footer>
	&copy; A12.2022.06776 (Muhamad Risqi Faiz)
</footer>

</html>
