<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Data Detail Penjualan</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
    min-width: 100%;
}
.table-title h2 {
    margin: 8px 0 0;
    font-size: 22px;
}
.search-box {
    position: relative;        
    float: right;
}
.search-box input {
    height: 34px;
    border-radius: 20px;
    padding-left: 35px;
    border-color: #ddd;
    box-shadow: none;
}
.search-box input:focus {
    border-color: #3FBAE4;
}
.search-box i {
    color: #a0a5b1;
    position: absolute;
    font-size: 19px;
    top: 8px;
    left: 10px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}    
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 95%;
    width: 30px;
    height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
    padding: 0;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 6px;
    font-size: 95%;
}    
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Data <b>Detail Penjualan</b></h2></div>
                    <div class="col-sm-4">
                    </div>
                </div>
            </div>
            <p><a href="tambahpenjualan.php" class="tambah" title="Tambah" data-toggle="tooltip">+ Tambah Data</a></p>
            <p><a href="tampilpenjualan.php" class="tambah" title="Tambah" data-toggle="tooltip">Tabel Penjualan</a></p>
            <table class="table table-striped table-hover table-bordered">
            <form action="" method="post">
              Cari berdasarkan
              <select name="pilih">
                <option value="id_detail">Id Detail</option>
                <option value="id_penjualan">Id Penjualan</option>
                <option value="id_produk">Id Produk</option>
                <option value="jumlah_produk">Jumlah Produk</option>
                <option value="sub_total">Sub Total</option>
              </select>
              <input type="text" name="tekscari" size="24">
              <input type="submit" name="cari" value="Cari">
              <input type="submit" name="semua" value="Tampilkan Semua">
            </form>
            <thead>
<tr>
<th>Id Detail</th> <th>Id Penjualan</th> <th>Id Produk</th> <th>Jumlah Produk</th> <th>Sub Total</th> <th>OPSI</th>
<?php
include "koneksi.php";
$tampil = "";
if (isset($_POST['cari'])) {
  $pilih = $_POST['pilih'];
  $tekscari = $_POST['tekscari'];
  $tampil = mysqli_query($koneksi, "select * from detail_penjualan where $pilih like '%$tekscari%'");
} else{
  $tampil = mysqli_query($koneksi, "select * from detail_penjualan");
}
foreach ($tampil as $row) {
  ?>
 <tr>
 <td><?php echo $row['id_detail']; ?></td>
 <td><?php echo $row['id_penjualan']; ?></td>
 <td><?php echo $row['id_produk']; ?></td>
 <td><?php echo $row['jumlah_produk']; ?></td>
 <td><?php echo $row['sub_total']; ?></td>
                    </td>
                    <td>
                    <a href="editdetailpenjualan.php?id_detail=<?php echo $row['id_detail']?>">Edit</a> |
                    <a href="hapusdetailpenjualan.php?id_detail=<?php echo $row['id_detail']?>">Delete</a>
 </td>
                    </tr>
                <?php
                }
                ?>   
                </tbody>
            </table>
            <a href="dashboardadmin.php" class="kembali" title="Kembali" data-toggle="tooltip">Kembali</a>
    </div>  
</div>   
</body>
</html>