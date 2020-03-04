<h2>PELANGGAN</h2>
<!-- <div><a href="?f=pelanggan&m=insert" class="btn btn-sm btn-success" role="button">Tambah Data </a>
</div> -->

<?php
    require_once '../dbcontroller.php';
    $db = new DB;
    $jumlahdata = $db->rowCount("SELECT id_pelanggan FROM tbl_pelanggan");
    $banyak = 5 ;

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $halaman = ceil($jumlahdata / $banyak);
    $sql = "SELECT * FROM tbl_pelanggan ORDER BY pelanggan ASC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>


<br>
<table class="table table-bordered w-70">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>Pelanggan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($row as $key ):?>
        <tr>
            <?php if ($key['aktif']== 1) {
                $status=  "AKTIF";
            }else {
                $status= "TIDAK AKTIF";
            }?>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['pelanggan'];?></td>
            <td><?php echo $key['alamat'];?></td>
            <td><?php echo $key['telp'];?></td>
            <td><?php echo $key['email'];?></td>
            <td><a href="?f=pelanggan&m=delete&id=<?php echo $key['id_pelanggan'];?>">Delete</a></td>
            <td><a href="?f=pelanggan&m=update&id=<?php echo $key['id_pelanggan'];?>"><?php echo $status; ?></a></td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a href="?f=pelanggan&m=select&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>