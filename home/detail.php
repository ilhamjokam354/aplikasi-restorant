<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    $jumlahdata = $db->rowCount("SELECT id_order_detail FROM vorderdetail WHERE id_order = $id");
    $banyak = 4 ;

    $halaman = ceil($jumlahdata / $banyak);
    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    
    $sql = "SELECT * FROM vorderdetail WHERE id_order = $id ORDER BY id_order_detail  ASC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>

<h2>DETAIL PEMBELIAN</h2>
<br>
<table class="table table-bordered w-70">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>

        </tr>
    </thead>

    <tbody>
        <?php if(!empty($row)){?>
        <?php foreach ($row as $key ):?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['tgl_order'];?></td>
            <td><?php echo $key['menu'];?></td>
            <td><?php echo $key['harga'];?></td>
            <td><?php echo $key['jumlah'];?></td>
            
            

        </tr>
        <?php endforeach ?>
        <?php }?>
    </tbody>
</table>

<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a href="?f=home&m=detail&id='.$key['id_order'].'&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>