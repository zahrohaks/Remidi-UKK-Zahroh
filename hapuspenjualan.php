<?php
    include_once "koneksi.php";
    if (isset($_GET['id_penjualan'])) {
        $id_penjualan    =$_GET['id_penjualan'];
    }
    else{
        echo "Oops! No ID Selected";
    }
    
    if (!empty($id_penjualan) && $id_penjualan != "") {
        $hapus =mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan='$id_penjualan'");
            ?>
                <script language="JavaScript">
                alert('Good! Delete data Penjualan berhasil ...');
                document.location='tampilpenjualan.php';
                </script>
            <?php        
    }
