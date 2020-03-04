<h3>Keranjang Belanja</h3>
<?php

    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        unset($_SESSION['_'.$id]);
        header('location:?f=home&m=beli');
    }
    if (isset($_GET['tambah'])) {
        $tambah = $_GET['tambah'];
        // echo $tambah;
        $_SESSION['_'.$tambah]++;
    }
    if (isset($_GET['kurang'])) {
        $kurang = $_GET['kurang'];
        //echo $kurang;
        $_SESSION['_'.$kurang]--;
        // cek apakah  kurang dari 0
        if ($_SESSION['_'.$kurang]== 0) {
            unset($_SESSION['_'.$kurang]);
        }

    }
    if (!isset($_SESSION['pelanggan'])) {
        echo "<script>
        alert('Maaf Anda Harus Login Dahulu');
        document.location.href='?f=home&m=login';
        </script>";
    }else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //echo $id;
            isi($id);
            header("location:?f=home&m=beli");
        } else {
            keranjang();
        }
       
    }

    
    

    
       
        
        function isi($id){
            if (isset($_SESSION['_'.$id])) {
                $_SESSION['_'.$id]++;
            }else {
                $_SESSION['_'.$id]=1;
            }
            
        }

        function keranjang(){
            global $db;
            $total = 0 ;   

            global $total;
            echo '
            <table class="table table-bordered w-70 ">
            <thead>
                <tr bgcolor="#4dc2d1">
                    <th >Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Hapus</th>
                </tr>
            </thead>
        
            <tbody>';
               
            
            
            foreach ($_SESSION as $key => $value) {
                if ($key<>'pelanggan' && $key<>'id_pelanggan' && $key<>'user' && $key<>'level' && $key<>'id_user') {
                    $id = substr($key,1);
                    $sql = "SELECT * FROM tbl_menu WHERE id_menu= $id";
                    // echo $sql;
                    // echo '<br>';
                    $row = $db->getAll($sql);
                    foreach ($row as $key ) {
                        echo '<tr>'.'<td>'.$key['menu'].'</td>';
                        echo '<td>'.$key['harga'].'</td>';
                        echo '<td><a href="?f=home&m=beli&tambah='.$key['id_menu'].'">[+]</a>&nbsp &nbsp'.$value.' &nbsp &nbsp <a href="?f=home&m=beli&kurang='.$key['id_menu'].'">[-]</a></td>';
                        echo '<td>'.$key['harga'] * $value.'</td>';
                        echo '<td><a href="?f=home&m=beli&hapus='.$key['id_menu'].'">Hapus</a></td>';
                        echo '</tr>';
                        $total = $total + ($key['harga'] * $value);
                    }
                    
                }
            }
                        echo '<tr>
                            <td colspan="4"><h4>Grand Total :</h4></td>
                            <td><h4>Rp.'.$total.'</h></td>
                        </tr>';

            echo ' </tbody>
            </table>';
        }
?>
<?php if (!empty($total)) {?>
<a href="?f=home&m=checkout&total=<?php echo $total;?>" class="btn btn-primary" role="button">Checkout</a>
<?php }?>