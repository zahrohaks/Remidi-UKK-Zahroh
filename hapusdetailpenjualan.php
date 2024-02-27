<?php
    include "koneksi.php";
    if (isset($_GET['id_detail'])) {
        $id_detail    =$_GET['id_detail'];
    }
    else{
        echo "Oops! No ID Selected";
    }
    
    if (!empty($id_detail) && $id_detail != "") {
        $hapus =mysqli_query($koneksi, "DELETE FROM detail_penjualan WHERE id_detail='$id_detail'");
            ?>
                <script language="JavaScript">
                alert('Good! Delete data Detail Penjualan berhasil ...');
                document.location='tampildetailpenjualan.php';
                </script>
            <?php        
    }
?>