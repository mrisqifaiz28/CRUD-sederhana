<?php
include "fungsi.php"; // masukan koneksi DB

// Ambil variable
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$email = $_POST["email"];

// Default sukses unggah foto 
$uploadOk = 1;
// Siapkan komponen untuk penyimpan foto
$folderupload = "foto/";

// basename : mengambil bagian akhir dari direktori tersebut
$fileupload = $folderupload . basename($_FILES['foto']['name']); // foto/A12.2018.05555.jpg
$filefoto = basename($_FILES['foto']['name']); // A12.2018.0555.jpg

// Ambil jenis file
$jenisfilefoto = strtolower(pathinfo($fileupload, PATHINFO_EXTENSION)); // jpg,png,gif

// Check jika file foto sudah ada
if (file_exists($fileupload)) {
    echo "<script>alert('Maaf, file foto sudah ada');</script>";
    $uploadOk = 0;
}

// Check ukuran file
if ($_FILES["foto"]["size"] > 1000000) {
    echo "<script>alert('Maaf, ukuran file foto harus kurang dari 1 MB');</script>";
    $uploadOk = 0;
}

// Seleksi extension file selain yang ditentukan yaitu jpg, png, jpeg dan gif ditolak
if ($jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg" && $jenisfilefoto != "gif") {
    echo "<script>alert('Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan');</script>";
    $uploadOk = 0;
}

// Check jika terjadi kesalahan
if ($uploadOk == 0) {
    echo "<script>alert('Maaf, file tidak dapat terupload');</script>";
} else {
    // move_uploaded_file adalah fungsi bawaan PHP yang berguna untuk mengecek apakah 
    // $lokasi_file telah diupload ke $direktori
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
        // Siapkan query dengan prepared statement untuk mencegah SQL Injection
        $stmt = $koneksi->prepare("INSERT INTO mhs (nim, nama, email, foto) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nim, $nama, $email, $filefoto);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan'); window.location.href='addMhs.php';</script>";
            exit();
        } else {
            echo "<script>alert('Data gagal tersimpan. Error: " . $stmt->error . "');</script>";
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file');</script>";
    }
}

// Tutup koneksi
$koneksi->close();
?>
