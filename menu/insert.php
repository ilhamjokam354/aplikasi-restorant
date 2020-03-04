<?php
    $row = $db->getAll("SELECT * FROM tbl_kategori ORDER BY kategori ASC");

?>

<h1>Tambah Data</h1>

<div class="form-group">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <select name="idkategori" id="">
                <?php foreach ($row as $key):?>
                <option value="<?php echo $key['id_kategori'];?>"><?php echo $key['kategori']; ?></option>
                <?php endforeach?>
            </select>
        </div>        
    
        <div class="form-group w-50">
            <label for="menu" autocomplete>Nama Menu:</label>
            <input type="text" class="form-control" name="menu" id="menu" required autofocus placeholder="Isikan Menu Disini"> 
        </div>
        <div class="form-group w-50">
            <label for="gambar" autocomplete>Gambar:</label> <br>
            <input type="file" name="gambar" id="gambar" required >
        </div>
        <div class="form-group w-50">
            <label for="harga" autocomplete>Harga:</label>
            <input type="text" class="form-control" number name="harga" id="harga" required  placeholder="Isikan Harga Disini"> 
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Simpan</button> 
        </div>
    </form>
</div>
 
<?php
    if (isset($_POST['simpan'])) {
    $idkategori = $_POST['idkategori'];
    $menu = $_POST['menu'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $temporary = $_FILES['gambar']['tmp_name'];
    
        if (empty($gambar)) {
            echo '<h2>Data Yang Anda Masukan Harus Lengkap</h2>?';
        }else {
        $sql = "INSERT INTO tbl_menu VALUES('',$idkategori,  '$menu', '$gambar', $harga )";
        move_uploaded_file($temporary , '../upload/'.$gambar);

        $db->runSql($sql);
        
        header('location:?f=menu&m=select');
        }
    }


?>