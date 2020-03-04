    <h2>MENU</h2>
    <div><a href="?f=menu&m=insert" class="btn btn-sm btn-success" role="button">Tambah Data </a>
    </div>

    <?php
        if (isset($_POST['opsi'])) {

            $opsi = $_POST['opsi'];
            $where = "WHERE id_kategori = $opsi ";
            //echo $where;
        }else {
            $opsi = 0;
            $where = "";
        }
    ?>

    <div class="mt-4 mb-4">
        <?php 
            $row = $db->getAll("SELECT * FROM tbl_kategori ORDER BY kategori ASC");
        ?>

        <form action="" method="post">
            <select name="opsi" onchange="this.form.submit()">
            <?php foreach ($row as $key): ?>
                <option <?php if($key['id_kategori']==$opsi ) echo 'selected';?> value="<?php echo $key['id_kategori'];?>" ><?php echo $key['kategori'];?></option>
            <?php endforeach ?>    
                <!-- <option value="">Kategori 2</option>
                <option value="">Kategori 3</option> -->
            </select>
        </form>
    </div>
<?php
    require_once '../dbcontroller.php';
    $db = new DB;
    $jumlahdata = $db->rowCount("SELECT id_menu FROM tbl_menu $where");
    $banyak = 3 ;

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $halaman = ceil($jumlahdata / $banyak);
    $sql = "SELECT * FROM tbl_menu $where ORDER BY menu ASC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>

<table class="table table-bordered w-50">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>

    <tbody>
        <?php if(!empty($row)){?>
        <?php foreach ($row as $key ):?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['menu'];?></td>
            <td><?php echo $key['harga'];?></td>
            <td> <img style="width:100px; " src="../upload/<?php echo $key['gambar'];?>" alt=""></td>
            <td><a href="?f=menu&m=delete&id=<?php echo $key['id_menu'];?>">Delete</a></td>
            <td><a href="?f=menu&m=update&id=<?php echo $key['id_menu'];?>">Update</a></td>

        </tr>
        <?php endforeach ?>
        <?php }?>
    </tbody>
</table>

<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a href="?f=menu&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>