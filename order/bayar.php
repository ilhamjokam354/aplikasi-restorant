<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT *  FROM tbl_order WHERE id_order = $id ";
        $row= $db->getItem($sql);
        
    }

?>

<h1>Pembayaran</h1>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="total" autocomplete>Total:</label>
            <input type="text" class="form-control" name="total" value="<?php echo $row['total'];?>" id="total" required  > 
        </div>
        <div class="form-group w-50">
            <label for="bayar" autocomplete>Bayar:</label>
            <input type="number" class="form-control" name="bayar"  id="bayar" required  > 
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Bayar</button>
        </div>
    </form>
</div>

<?php
    if (isset($_POST['simpan'])) {
    $bayar = $_POST['bayar'];
    $kembali = $bayar - $row['total'];
    $sql = "UPDATE tbl_order SET bayar = $bayar, kembali = $kembali, status = 1 WHERE id_order = $id";
    
    if ($kembali < 0) {
        echo "
        <script>
        alert('Pembayaran Kurang');
        document.location.href='?f=order&m=bayar&id=".$row['id_order']=$id."';
        </script>
        ";
    }else {
        
        $db->runSql($sql);
        
        header('location:?f=order&m=select');    
    }
    
    
    
    }

?>