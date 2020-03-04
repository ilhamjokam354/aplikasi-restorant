<h2>KATEGORI</h2>
<div><a href="?f=kategori&m=insert" class="btn btn-sm btn-success" role="button">Tambah Data </a>
</div>

<?php
    require_once '../dbcontroller.php';
    $db = new DB;
    $jumlahdata = $db->rowCount("SELECT id_kategori FROM tbl_kategori");
    $banyak = 5 ;

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $halaman = ceil($jumlahdata / $banyak);
    $sql = "SELECT * FROM tbl_kategori ORDER BY kategori ASC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>


<br>
<table class="table table-bordered w-50">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>Kategori</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>

    <tbody>
        <?php if(!empty($row)){?>
        <?php foreach ($row as $key ):?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['kategori'];?></td>
            <td><a href="?f=kategori&m=delete&id=<?php echo $key['id_kategori'];?>">Delete</a></td>
            <td><a href="?f=kategori&m=update&id=<?php echo $key['id_kategori'];?>">Update</a></td>

        </tr>
        <?php endforeach ?>
        <?php }?>
    </tbody>
</table>



<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        
        echo '<a href="?f=kategori&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>