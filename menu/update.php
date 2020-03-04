<?php
    if (isset($_GET)) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_menu WHERE id_menu=$id";
        $item = $db->getItem($sql);
        
        $idkategori = $item['id_kategori'];
        
        

    }
    $row = $db->getAll("SELECT * FROM tbl_kategori ORDER BY kategori ASC");

?>

<h1>Update Data</h1>

<div class="form-group">
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <select name="idkategori" id="" value="<?php echo $item['id_kategori'] ?>">
                <?php foreach ($row as $key):?>
                <option <?php if($idkategori == $key['id_kategori']) echo 'selected';?> value="<?php echo $key['id_kategori'];?>"><?php echo $key['kategori']; ?></option>
                <?php endforeach?>
            </select>
        </div>       
    
        <div class="form-group w-50">
            <label for="menu" >Nama Menu:</label>
            <input type="text" class="form-control" name="menu" id="menu" required  value="<?php echo $item['menu']?>"> 
        </div>
        <div class="form-group w-50">
            <label for="gambar" >Gambar:</label> <br>
            <input type="file" name="gambar" id="gambar"  >
        </div>
        <div class="form-group w-50">
            <label for="harga" >Harga:</label>
            <input type="text" class="form-control" number name="harga" id="harga" required  value="<?php echo $item['harga']?>"> 
        </div>
        <div>
            <button type="submit" name="simpan" class="btn btn-sm btn-primary" >Simpan</button> 
        </div>
    </form>
</div>
  
<?php
    if (isset($_POST['simpan'])) {
    $idkategori = $_POST['idkategori'];
    $menu = $_POST['menu'];
    $gambar = $item['gambar'];
    $harga = $_POST['harga'];

    $temporary = $_FILES['gambar']['tmp_name'];
        if (!empty($temporary)) {
            $gambar = $_FILES['gambar']['name'];
            move_uploaded_file($temporary , '../upload/'.$gambar);
        }

    $sql = "UPDATE tbl_menu SET id_kategori=$idkategori, menu='$menu', gambar='$gambar', harga=$harga WHERE id_menu=$id";
    //echo $sql;
    $db->runSql($sql);
    
    header('location:?f=menu&m=select');
    
    
    }


?>