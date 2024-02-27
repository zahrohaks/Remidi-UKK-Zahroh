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
        $id_penjualan=$_POST['id_penjualan'];
        $tgl_penjualan=$_POST['tgl_penjualan'];

        $simpan=mysqli_query($koneksi, "update penjualan set 
        id_penjualan='$id_penjualan',
        tgl_penjualan='$tgl_penjualan'
        where id_penjualan='$id_penjualan'");

        if ($simpan) {
            header("location:tampilpenjualan.php");
        } else {
            echo "<div class='alert alert-danger' >Gagal menambah data baru!</div> ";
        }
    }
?>
    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
            <h2>Form Update Data Penjualan</h2>
            <form method="post" action=""> 
                <?php
                $tampil=mysqli_query($koneksi,"select * from penjualan where id_penjualan='$_GET[id_penjualan]'");
                foreach ($tampil as $row) {
                ?>
                <div class="form-group">
                    <label><b>Id Penjualan</b></label>
                    <input value="<?php echo $row['id_penjualan']; ?>" class="form-control" placeholder="id penjualan" name="id_penjualan" readonly>
                </div>
                <div class="form-group">
                <label><b>Tanggal Penjualan</b></label>
                    <input value="<?php echo $row['tgl_penjualan']; ?>" type="date" class="form-control" placeholder="tgl penjualan" name="tgl_penjualan">
                </div>
                <button type="submit" name="ok" class="btn btn-primary">SIMPAN</button>
                <a href="tampilpenjualan.php" class="btn btn-danger">CANCEL</a>
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