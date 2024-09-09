<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$id=$_POST["npp"];
$nama=$_POST["namadosen"];
$homebase=$_POST["homebase"];

//membuat query
$sql = "UPDATE dosen SET namadosen='$nama', homebase='$homebase' WHERE npp='$id'";
mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
header("location:updateDosen.php");
?>