<?php
    $email = $_SESSION['pelanggan'];
    $jumlahdata = $db->rowCount("SELECT id_order FROM vorder WHERE email = '$email'");
    $banyak = 5 ;

    $halaman = ceil($jumlahdata / $banyak);
    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    
    $sql = "SELECT * FROM vorder WHERE email = '$email' ORDER BY tgl_order DESC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>

<h2>HISTORY PEMBELIAN</h2>
<br>
<table class="table table-bordered w-50">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Detail</th>

        </tr>
    </thead>

    <tbody>
        <?php if(!empty($row)){?>
        <?php foreach ($row as $key ):?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $key['tgl_order'];?></td>
            <td><?php echo $key['total'];?></td>
            <td ><a href="?f=home&m=detail&id=<?php echo $key['id_order'];?>">Detail</a></td>
            

        </tr>
        <?php endforeach ?>
        <?php }?>
    </tbody>
</table>

<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a href="?f=home&m=histori&p='.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>