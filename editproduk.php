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
    if (isset($_POST["ok"]))
    {
        $id_produk=$_POST['id_produk'];
        $nama_produk=$_POST['nama_produk'];
        $harga=$_POST['harga'];
        $stok=$_POST['stok'];

        $simpan=mysqli_query($koneksi, "update produk set 
        id_produk='$id_produk',
        nama_produk='$nama_produk',
        harga='$harga',
        stok='$stok'
        where id_produk='$id_produk'");

        if ($simpan) {
            header("location:tampilproduk.php");
        } else {
            echo "<div class='alert alert-danger' >Gagal menambah data baru!</div> ";
        }
    }
?>
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
            <h2>Form Update Data Produk</h2>
            <form method="post" action=""> 
                <?php
                $tampil=mysqli_query($koneksi,"select * from produk where id_produk='$_GET[id_produk]'");
                foreach ($tampil as $row) {
                ?>
                <div class="form-group">
                    <label><b>Id Produk</b></label>
                    <input value="<?php echo $row['id_produk']; ?>" class="form-control" placeholder="id produk" name="id_produk" readonly>
                </div>
                <div class="form-group">
                <label><b>Nama Produk</b></label>
                    <input value="<?php echo $row['nama_produk']; ?>" type="text" class="form-control" placeholder="nama produk" name="nama_produk">
                </div>
                <div class="form-group">
                <label><b>Harga</b></label>
                    <input value="<?php echo $row['harga']; ?>" type="text" class="form-control" placeholder="harga" name="harga">
                </div>
                <div class="form-group">
                <label><b>Stok</b></label>
                    <input value="<?php echo $row['stok']; ?>" type="text" class="form-control" placeholder="stok" name="stok">
                </div>
                <button type="submit" name="ok" class="btn btn-primary">SIMPAN</button>
                <a href="tampilproduk.php" class="btn btn-danger">CANCEL</a>
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