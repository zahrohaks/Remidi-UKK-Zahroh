<?php
    include "koneksi.php";
    if (isset($_GET['id_produk'])) {
        $id_produk    =$_GET['id_produk'];
    }
    else{
        echo "Oops! No ID Selected";
    }
    
    if (!empty($id_produk) && $id_produk != "") {
        $hapus =mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id_produk'");
            ?>
                <script language="JavaScript">
                alert('Good! Delete data Produk berhasil ...');
                document.location='tampilproduk.php';
                </script>
            <?php        
    }
?>