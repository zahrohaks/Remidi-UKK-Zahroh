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

</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              Kasir
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <?php 
include ("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $idp = $_POST['id_penjualan'];
    $tanggal = date("Y-m-d");
    $idd = $_POST['id_detail'];
    $idpr = $_POST['id_produk'];
    $jumlah = $_POST['jumlah_produk'];

    // Query untuk mengurangi stok produk
    $queryStok = "SELECT stok, harga FROM produk WHERE id_produk = '$idpr'";
    $resultStok = mysqli_query($koneksi, $queryStok);
    $rowStok = mysqli_fetch_assoc($resultStok);
    $stok_produk = $rowStok['stok'];
    $Harga = $rowStok['harga'];

    // Hitung subtotal
    $sub = $Harga * $jumlah;

    if ($stok_produk >= $jumlah) {
        // Kurangi stok produk
        $stok_baru = $stok_produk - $jumlah;
        
        // Update stok produk di database
        $queryUpdateStok = "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$idpr'";
        mysqli_query($koneksi, $queryUpdateStok);
        
        // Simpan data ke tabel detail_penjualan
        $queryDetail = "INSERT INTO detail_penjualan (id_detail, id_penjualan, id_produk, jumlah_produk, sub_total) VALUES ('$idd', '$idp', '$idpr', '$jumlah','$sub')";
        mysqli_query($koneksi, $queryDetail);
        
        // Hitung total harga dari semua barang yang ada dalam penjualan
        $queryTotal = "SELECT SUM(sub_total) AS total_harga FROM detail_penjualan WHERE id_penjualan = '$idp'";
        $resultTotal = mysqli_query($koneksi, $queryTotal);
        $rowTotal = mysqli_fetch_assoc($resultTotal);
        $totalHarga = $rowTotal['total_harga'];
        
        // Simpan data ke tabel penjualan
        $queryPenjualan = "INSERT INTO penjualan (id_penjualan, tgl_penjualan, total_harga) VALUES ('$idp', '$tanggal', '$totalHarga')";
        mysqli_query($koneksi, $queryPenjualan);

    // Redirect atau lakukan tindakan lain setelah berhasil menyimpan
    header("Location: tampildetailpenjualan.php");
    exit();
} else {
    // Stok tidak mencukupi
    echo "Stok produk tidak mencukupi untuk transaksi ini.";
}

    // Redirect atau lakukan tindakan lain setelah berhasil menyimpan
    header("Location: tampildetailpenjualan.php");
    exit();
}
?>

            <!-- Page content-->
            <section class="py-5">
                <div class="container px-5">
                    <!-- Contact form-->
                    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                        <div class="text-center mb-5">
                            
                            <h1 class="fw-bolder">FORM INPUT DATA</h1>
                            <p class="lead fw-normal text-muted mb-0">FORM INPUT DATA KASIR PENJUALAN</p>
                        </div>
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-8 col-xl-6">
                                <form action="#" data-sb-form-api-token="API_TOKEN" method="POST">
                                    <!-- NIK input with person icon -->
                                    <div class="form-group">
                                        <label><b>Id Penjualan</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" class="form-control" placeholder="Masukkan Id Penjualan anda" name="id_penjualan" required>
                                        </div>
                                    </div>

                                    <!-- Nama input with person icon -->
                                    <div class="form-group">
                                        <label><b>Tanggal Penjualan</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="date" class="form-control" placeholder="" name="tgl_penjualan" required>
                                        </div>
                                    </div>
                                    <script>
                                    // JavaScript code to set the default value to today's date
                                    document.getElementById('tgl_penjualan').valueAsDate = new Date();
                                    </script>

                                    <!-- No telepon input with person icon -->
                                    <div class="form-group">
                                        <label><b>Id Detail</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                            <input type="text" class="form-control" placeholder="Masukkan Id Detail anda" name="id_detail" required>
                                        </div>
                                    </div>

                                    <!-- Tanggal Pengaduan input with calendar icon -->
                                    <div class="form-group">
                                    <label for="id_produk">Id Produk</label><select name="id_produk" class="form-control">
                                    <option disabled selected>Pilih</option>
                                    <?php
                                    $t_produk = mysqli_query($koneksi, "select id_produk, nama_produk from produk");
                                    foreach ($t_produk as $produk) {
                                    echo "<option value=$produk[id_produk]>$produk[nama_produk]</option>";
                      }            
                      ?>
                      </select>
                                </div>

                                    <!-- Isi input with chat-text icon -->
                                    <div class="form-group">
                                        <label><b>Jumlah Produk</b></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-chat-text"></i></span>
                                            <input type="text" class="form-control" placeholder="Masukkan Jumlah Produk anda" name="jumlah_produk" required>
                                        </div>
                                    </div>


                                        <!-- Add some space between the input and buttons -->
                                    <div class="mb-3"></div>

                                    <!-- Center the buttons using text-center class -->
                                    <div class="text-center">
                                        <button type="submit" name="ok" class="btn btn-primary fw-bold">Simpan</button>
                                        <a href="dashboardadmin.php" class="btn btn-secondary fw-bold">Kembali</a>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
        </main> 
        <!-- Footer-->
        
        <!-- Bootstrap core JS-->
        <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
</body>
</html>