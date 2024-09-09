<!DOCTYPE html>
<html>

<head>
    <title>Sistem Informasi Akademik::Daftar Mahasiswa</title>
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

        .btn-custom {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-success-custom {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-success-custom:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .btn-outline-primary-custom {
            border-color: #007bff;
            color: blue;
        }

        .btn-outline-primary-custom:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-outline-danger-custom {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger-custom:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    //memanggil file berisi fungsi2 yang sering dipakai
    require "fungsi.php";
    require "head.html";

    /* ---- cetak data per halaman --------- */

    //--------- konfigurasi
    //jumlah data per halaman
    $jmlDataPerHal = 5;

    //pencarian data
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $sql = "select * from mhs where nim like'%$cari%' or
                                    nama like '%$cari%' or
                                    email like '%$cari%'";
    } else {
        $sql = "select * from mhs";
    }

    $qry = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    $jmlData = mysqli_num_rows($qry);

    // CEIL() digunakan untuk mengembalikan nilai integer terkecil yang lebih besar dari 
    //atau sama dengan angka.
    $jmlHal = ceil($jmlData / $jmlDataPerHal);

    if (isset($_GET['hal'])) {
        $halAktif = $_GET['hal'];
    } else {
        $halAktif = 1;
    }

    $awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

    //Jika tabel data kosong
    $kosong = false;
    if (!$jmlData) {
        $kosong = true;
    }

    //Klausa LIMIT digunakan untuk membatasi jumlah baris yang dikembalikan oleh pernyataan SELECT
    //data berdasar pencarian atau tidak
    if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $sql = "select * from mhs where nim like'%$cari%' or
                                    nama like '%$cari%' or
                                    email like '%$cari%'
                                    limit $awalData,$jmlDataPerHal";
    } else {
        $sql = "select * from mhs limit $awalData,$jmlDataPerHal";
    }

    //Ambil data untuk ditampilkan
    $hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    ?>
    <div class="container mt-5">
        <div class="utama">
            <h2 class="text-center">Daftar Mahasiswa</h2>
            <div class="text-center mb-3">
                <a href="cetakMHS.php" class="btn btn-primary-custom btn-custom"><span class="fas fa-print"></span> Print</a>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success-custom btn-custom" href="addMhs.php">Tambah Data</a>
                <form action="" method="post" class="d-flex">
                    <input class="form-control mr-2" type="text" name="cari" placeholder="Cari data mahasiswa..." autofocus autocomplete="off" id="keyword">
			
                    <button class="btn btn-success-custom btn-custom" type="submit" name="cari" id="tombol-cari">Cari</button>
                </form>
            </div>

            <ul class="pagination justify-content-center">
                <?php
                //navigasi pagination
                //cetak navigasi back
                if ($halAktif > 1) {
                    $back = $halAktif - 1;
                    echo "<li class='page-item'><a class='page-link' href=?hal=$back>&laquo;</a></li>";
                }

                //cetak angka halaman
                for ($i = 1; $i <= $jmlHal; $i++) {
                    if ($i == $halAktif) {
                        echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:red;'>$i</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href=?hal=$i>$i</a></li>";
                    }
                }

                //cetak navigasi forward
                if ($halAktif < $jmlHal) {
                    $forward = $halAktif + 1;
                    echo "<li class='page-item'><a class='page-link' href=?hal=$forward>&raquo;</a></li>";
                }
                ?>
            </ul>

            <div id="container">
                <!-- Cetak data dengan tampilan tabel -->
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        //jika data tidak ada
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
                            // $awalData==0, data kalau tampail di page pertama, maka 
                            if ($awalData == 0) {
                                $no = $awalData + 1;
                            } else {
                                $no = $awalData + 1;
                            }
                            while ($row = mysqli_fetch_assoc($hasil)) {
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row["nim"] ?></td>
                                    <td><?php echo $row["nama"] ?></td>
                                    <td><?php echo $row["email"] ?></td>
                                    <td><img src="<?php echo "foto/" . $row["foto"] ?>" height="50"></td>
                                    <td>
                                        <a class="btn btn-outline-primary-custom btn-sm" href="editMhs.php?kode=<?php echo $row['id'] ?>">Edit</a>
                                        <a class="btn btn-outline-danger-custom btn-sm" href="hpsMhs.php?kode=<?php echo $row["id"] ?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
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
    </div>
    <footer>
        &copy; A12.2022.06776 (Muhamad Risqi Faiz)
    </footer>
    <script src="js/script.js"> </script>
</body>

</html>
