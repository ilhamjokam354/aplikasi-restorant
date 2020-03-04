<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT *  FROM tbl_kategori WHERE id_kategori = $id ";
        $row= $db->getItem($sql);
    }

?>
<h1>Update Data</h1>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="kategorii" autocomplete>Kategori:</label>
            <input type="text" class="form-control" name="kategori" value="<?php echo $row['kategori'];?>" id="kategorii" required  > 
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Simpan</button>
        </div>
    </form>
</div>

<?php
    if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];
    $sql = "UPDATE tbl_kategori SET kategori = '$kategori' WHERE id_kategori = $id";
    
    $db->runSql($sql);
    
    echo '<script>
    alert("Data Berhasil Diubah");
    document.location.href="?f=kategori&m=select";
    </script>';
    }

?>