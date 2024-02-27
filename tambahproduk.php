<?php
session_start();
if (!isset($_SESSION["username"])) {
	header("location:login.php");
} else
?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<title>Form Produk</title>
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-4 offset-md-4">

				<div class="card mt-5">
					<div class="card-title text-center">
						<h1>Form Produk</h1>
					</div>
					<div class="card-body">
						<form action="tambahaksiproduk.php" method="post">
							<div class="form-group">
								<label for="id_produk">Id Produk</label>
								<input type="text" name="id_produk" class="form-control" id="id_produk" aria-describedby="id_produk" placeholder="id_produk">

							</div>
                            <div class="form-group">
								<label for="nama_produk">Nama Produk</label>
								<input type="text" name="nama_produk" class="form-control" id="nama_produk" aria-describedby="nama_produk" placeholder="nama_produk">

							</div>
                            <div class="form-group">
								<label for="harga">Harga</label>
								<input type="text" name="harga" class="form-control" id="harga" aria-describedby="harga" placeholder="harga">

							</div>
                            <div class="form-group">
								<label for="stok">Stok</label>
								<input type="text" name="stok" class="form-control" id="stok" aria-describedby="stok" placeholder="stok">

							</div>
							

							<button type="submit" class="btn btn-primary">Submit</button>
              <a href="tampilproduk.php" class="btn btn-primary">
                        Cancel
                      </a>
						</form>

					</div>
				</div>
			</div>

		</div>

	</div>
</body>