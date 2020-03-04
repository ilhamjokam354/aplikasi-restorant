<h2>USER</h2>
<div><a href="?f=user&m=insert" class="btn btn-sm btn-success" role="button">Tambah Data </a>
</div>

<?php
    require_once '../dbcontroller.php';
    $db = new DB;
    $jumlahdata = $db->rowCount("SELECT id_user FROM tbl_user");
    $banyak = 5 ;

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $halaman = ceil($jumlahdata / $banyak);
    $sql = "SELECT * FROM tbl_user ORDER BY user ASC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>


<br>
<table class="table table-bordered w-70">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>User</th>
            <th>Email</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
    </thead>

    <tbody>
       
        <?php foreach ($row as $key ):?>
            <?php
            if ($key['aktif']== 1) {
                $aktif ='AKTIF';
            }else {
                $aktif ='BANNED';
            }
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['user'];?></td>
            <td><?php echo $key['email'];?></td>
            <td><?php echo $key['level'];?></td>
            <td><a href="?f=user&m=delete&id=<?php echo $key['id_user'];?>">Delete</a></td>
            <td><a href="?f=user&m=update&id=<?php echo $key['id_user'];?>"><?php echo $aktif;?></a></td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a href="?f=user&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>