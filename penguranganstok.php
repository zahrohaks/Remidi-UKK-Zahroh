<?php
if (isset($_POST['ok'])) {
    $idp = $_POST['id_penjualan'];
    $tanggal = date("Y-m-d");
    $idd = $_POST['id_detail'];
    $idpr = $_POST['id_produk'];
    $jumlah = $_POST['jumlah_produk'];
    
    include "koneksi.php";    
    $selSto =mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$idpr'");
    $sto    =mysqli_fetch_array($selSto);
    $stok    =$sto['stok'];
    $harga = $sto['harga'];
    $sub = $harga*$jumlah;
    //menghitung sisa stok
    $sisa    =$stok-$jumlah;
    
    if ($stok < $jumlah) {
        ?>
        <script language="JavaScript">
            alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
            document.location='./';
        </script>
        <?php
    }
    //proses    
    else{
        $queryPenjualan = "INSERT INTO penjualan (id_penjualan, tgl_penjualan) VALUES ('$idp', '$tanggal')";
        mysqli_query($koneksi, $queryPenjualan);

        $queryDetail = "INSERT INTO detail_penjualan (id_detail, id_penjualan, id_produk, jumlah_produk) VALUES ('$idd', '$idp', '$idpr', '$jumlah')";
    mysqli_query($koneksi, $queryDetail);
    
            if($insert){
                //update stok
                $upstok= mysqli_query($koneksi, "UPDATE produk SET stok='$sisa' WHERE id_produk='$idpr'");
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='./';
                </script>
                <?php
            }
            else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
    }
    }
?>