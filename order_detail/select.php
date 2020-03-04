<h2>ORDER DETAIL PEMBELIAN</h2>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50 float-left">
            <label for="tanggalawal" >Tanggal Awal:</label>
            <input type="date" class="form-control" autofocus  name="tanggalawal" id="tanggalawal" required> 
        </div>
        <div class="form-group w-50 float-left ">
            <label for="tanggalakhir" >Tanggal Akhir:</label>
            <input type="date" class="form-control"  autofocus name="tanggalakhir" id="tanggalakhir" required> 
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Cari</button>
        </div>
    </form>
</div>

<?php
    

    $jumlahdata = $db->rowCount("SELECT id_order_detail FROM vorderdetail ");
    $banyak = 5 ;

    $halaman = ceil($jumlahdata / $banyak);
    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    
    $sql = "SELECT * FROM vorderdetail ORDER BY id_order_detail DESC LIMIT $mulai, $banyak";

    if (isset($_POST['simpan'])) {
        $tanggalawal = $_POST['tanggalawal'];
        $tanggalakhir = $_POST['tanggalakhir'];
        $sql = "SELECT * FROM vorderdetail WHERE tgl_order BETWEEN '$tanggalawal' AND '$tanggalakhir' ";
    }   
    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
    $total = 0;
?>


<br>
<table class="table table-bordered w-50">
    <thead>
        <tr bgcolor="#4dc2d1">
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Alamat</th>
            

        </tr>
    </thead>

    <tbody>
        <?php if(!empty($row)){?>
        <?php foreach ($row as $key ):?>
            <?php
                if ($key['status'] == 0) {
                    $status = '<td ><a href="?f=order&m=bayar&id='.$key['id_order'].'">Bayar</a></td>';
                }else {
                    $status = '<td>Lunas</td>';
                }    
            ?>
        <tr>
            <td><?php echo $no++ ?></td>          
            <td><?php echo $key['pelanggan'];?></td>
            <td><?php echo $key['tgl_order'];?></td>
            <td><?php echo $key['menu'];?></td>
            <td><?php echo $key['harga'];?></td>
            <td><?php echo $key['jumlah'];?></td>
            <td><?php echo $key['jumlah'] * $key['harga'];?></td>
            <td><?php echo $key['alamat'];?> </td>
            
            <?php
            
                $total = $total + ($key['jumlah'] * $key['harga']);
            
            ?>
        </tr>
        <?php endforeach ?>
        <?php }?>

        <tr>
            <td colspan="6"><h3>GRAND TOTAL:</h3></td>
            <td colspan="2"><h4><?php echo $total;?></h4></td>
        </tr>
    </tbody>
</table>

<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a href="?f=order_detail&m=select&p='.$i.'" >'.$i.'</a>';
        echo '&nbsp &nbsp';
    }

?>