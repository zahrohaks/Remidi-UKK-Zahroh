<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
 
// menginput data ke database
mysqli_query($koneksi,"insert into produk values('$id_produk','$nama_produk','$harga','$stok')");
 
// mengalihkan halaman kembali ke index.php
header("location:tampilproduk.php");
 
?>