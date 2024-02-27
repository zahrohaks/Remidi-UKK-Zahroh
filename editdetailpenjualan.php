<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
} else 
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Kasir</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

  <?php
include "koneksi.php";

if (isset($_POST["ok"])) {
    $id_detail = $_POST['id_detail'];
    $id_penjualan = $_POST['id_penjualan'];
    $id_produk = $_POST['id_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];
    
    // Pastikan untuk melakukan validasi dan pembersihan data sebelum digunakan dalam kueri SQL

    // Misalnya, Anda dapat menggunakan fungsi mysqli_real_escape_string untuk membersihkan data dari potensi serangan SQL injection
    $id_detail = mysqli_real_escape_string($koneksi, $id_detail);
    $id_penjualan = mysqli_real_escape_string($koneksi, $id_penjualan);
    $id_produk = mysqli_real_escape_string($koneksi, $id_produk);
    $jumlah_produk = mysqli_real_escape_string($koneksi, $jumlah_produk);

    // Ambil nilai harga produk dari database berdasarkan ProdukID yang dipilih
    $queryHarga = "SELECT harga FROM produk WHERE id_produk = '$id_produk'";
    $resultHarga = mysqli_query($koneksi, $queryHarga);
    $rowHarga = mysqli_fetch_assoc($resultHarga);
    $hargaProduk = $rowHarga['harga'];

    // Hitung SubTotal
    $subTotal = $hargaProduk * $jumlah_produk;

    $simpan = mysqli_query($koneksi, "UPDATE detail_penjualan SET
        id_penjualan='$id_penjualan',
        id_produk='$id_produk',
        jumlah_produk='$jumlah_produk',
        sub_total='$subTotal'
        WHERE id_detail='$id_detail'");

if ($simpan) {
  // Perbarui TotalHarga di tabel penjualan
  $queryTotalHarga = "SELECT SUM(sub_total) AS total_harga FROM detail_penjualan WHERE id_penjualan = '$id_penjualan'";
  $resultTotalHarga = mysqli_query($koneksi, $queryTotalHarga);
  $rowTotalHarga = mysqli_fetch_assoc($resultTotalHarga);
  $totalHarga = $rowTotalHarga['total_harga'];

  // Update TotalHarga di tabel penjualan
  $updateTotalHarga = mysqli_query($koneksi, "UPDATE penjualan SET total_harga = '$totalHarga' WHERE id_penjualan = '$id_penjualan'");

  if ($updateTotalHarga) {
      header("location:tampildetailpenjualan.php");
      exit(); // Pastikan untuk keluar setelah melakukan redirect
  } else {
      // Tambahkan pesan kesalahan jika penyimpanan gagal
      $errorMessage = "Gagal Memperbarui total_harga: " . mysqli_error($koneksi);
      echo "<div class='alert alert-danger'>$errorMessage</div>";
  }
} else {
  // Tambahkan pesan kesalahan jika penyimpanan gagal
  $errorMessage = "Gagal Menyimpan Data Detail Penjualan: " . mysqli_error($koneksi);
  echo "<div class='alert alert-danger'>$errorMessage</div>";
}
}
?>
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
            <h2>Form Update Data Detail Penjualan</h2>
            <form method="post" action=""> 
                <?php
                $tampil=mysqli_query($koneksi,"select * from detail_penjualan where id_detail='$_GET[id_detail]'");
                foreach ($tampil as $row) {
                ?>
                <div class="form-group">
                    <label><b>Id Detail</b></label>
                    <input value="<?php echo $row['id_detail']; ?>" class="form-control" placeholder="id detail" name="id_detail" readonly>
                </div>
                <div class="form-group">
                <label><b>Id Penjualan</b></label>
                    <input value="<?php echo $row['id_penjualan']; ?>" type="text" class="form-control" placeholder="id penjualan" name="id_penjualan" readonly>
                </div>
                <div class="form-group">
                <label><b>Id Produk</b></label>
                    <input value="<?php echo $row['id_produk']; ?>" type="text" class="form-control" placeholder="id produk" name="id_produk">
                </div>
                <div class="form-group">
                <label><b>Jumlah Produk</b></label>
                    <input value="<?php echo $row['jumlah_produk']; ?>" type="text" class="form-control" placeholder="jumlah produk" name="jumlah_produk">
                </div>
                <button type="submit" name="ok" class="btn btn-primary">SIMPAN</button>
                <a href="tampildetailpenjualan.php" class="btn btn-danger">CANCEL</a>
                <?php } ?>
            </form>
        </div>
      </div>
    </div>

    <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>