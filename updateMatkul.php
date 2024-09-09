<!DOCTYPE html>
<html>

<head>
	<title>Sistem Informasi Akademik::Daftar Mata Kuliah</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap4/js/bootstrap.js"></script>
	<!-- Use fontawesome 5-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style>
    .utama {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 80px;
        margin-top: 20px;
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

    .pagination .page-link {
        color: #007bff;
    }

    .pagination .page-link:hover {
        color: #0056b3;
    }

    .btn-tambah {
        background-color: green;
        color: white;
    }

    .btn-tambah:hover {
        background-color: darkgreen;
    }

    .btn-cari {
        background-color: white;
        color: green;
        border: 1px solid green;
    }

    .btn-cari:hover {
        background-color: green;
        color: white;
    }
</style>

</head>

<body>
	<?php

	//memanggil file berisi fungsi2 yang sering dipakai
	require "fungsi.php";
	require "head.html";

	/* cetak data */
	if (isset($_POST['cari'])) {
		$cari = $_POST['cari'];
		$sql = "select * from matkul where idmatkul like'%$cari%' or
						  namamatkul like '%$cari%' or
						  sks like '%$cari%' or
						  jns like '%$cari%' or
						  smt like '%$cari%'";
	} else {
		$sql = "select * from matkul;";
	}
	$hasil = mysqli_query($koneksi, $sql) or die(mysql_error($koneksi));
	$kosong = false;
	if (!mysqli_num_rows($hasil)) {
		$kosong = true;
	}
	?>
<div class="container mt-5">
        <div class="utama">
            <h2 class="text-center">Daftar Mata Kuliah</h2>
            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-tambah" href="addMatkul.php">Tambah Data</a>
                <form action="" method="post" class="d-flex">
                    <input class="form-control mr-2" type="text" name="cari" placeholder="Cari data mata kuliah..." autofocus autocomplete="off">
                    <button class="btn btn-cari" type="submit">Cari</button>
                </form>
            </div>
			<!-- Cetak data dengan tampilan tabel -->
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>No.</th>
						<th>Kode</th>
						<th>Nama mata kuliah</th>
						<th>SKS</th>
						<th>Jenis</th>
						<th>Semester</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//jika data tidak ada
					if ($kosong) {
					?>
						<tr>
							<th colspan="7">
								<div class="alert alert-info alert-dismissible fade show text-center">
									Data tidak ada
								</div>
							</th>
						</tr>
						<?php
					} else {
						$no = 1;
						while ($row = mysqli_fetch_assoc($hasil)) {
						?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $row["idmatkul"] ?></td>
								<td><?php echo $row["namamatkul"] ?></td>
								<td><?php echo $row["sks"] ?></td>
								<td><?php echo $row["jns"] ?></td>
								<td><?php echo $row["smt"] ?></td>
								<td>
									<a class="btn btn-outline-primary btn-sm" href="editMatkul.php?kode=<?php echo $row['idmatkul'] ?>">Edit</a>
									<a class="btn btn-outline-danger btn-sm" href="hpsMatkul.php?kode=<?php echo $row["idmatkul"] ?>" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
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

</html>