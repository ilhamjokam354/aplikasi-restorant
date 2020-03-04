<h1>Tambah Data</h1>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="kategorii" autocomplete>Kategori:</label>
            <input type="text" class="form-control" name="kategori" id="kategorii" required autofocus placeholder="Isikan Kategori Disini"> 
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Simpan</button>
        </div>
    </form>
</div>
 
<?php
    if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];
    $sql = "INSERT INTO tbl_kategori VALUES('', '$kategori' )";

    $db->runSql($sql);
    
    header('location:?f=kategori&m=select');
    }

?>