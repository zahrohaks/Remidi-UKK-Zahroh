<?php 
include 'koneksi.php';
$id_penjualan = $_POST['id_penjualan'];
$tgl_penjualan = $_POST['tgl_penjualan'];
$total_harga = $_POST['total_harga'];
 
mysql_query("INSERT INTO penjualan VALUES('','$id_penjualan','$tgl_penjualan','$total_harga')");
 
header("location:tampilpenjualan.php");
?>