<?php
    if (isset($_GET['total'])) {
        $total =$_GET['total'];
        $idorder = idOrder();
        $idpelanggan = $_SESSION['id_pelanggan'];
        $tanggal = date('Y,m,d');
        // echo 'Rp.'.$total;
        // echo '<br>';
        //echo idOrder();
        // echo '<br>';
        $sql = "SELECT * FROM tbl_order WHERE id_order = $idorder";

        $count = $db->rowCount($sql);
        if ($count == 0) {
            insertOrder($idorder, $idpelanggan, $tanggal, $total);
            insertOrderDetail($idorder);    
        }else {
            insertOrderDetail($idorder); 
        }
        
        kosongkanSession();
        header('location:?f=home&m=checkout');

        
    }else {
        info();
    }

    function idOrder(){
        global $db;
        $sql = "SELECT id_order FROM tbl_order ORDER BY id_order DESC";
        $jumlah = $db->rowCount($sql);

        if ($jumlah == 0) {
            $id = 1;
        }else {
            $item = $db->getItem($sql);
            $id = $item['id_order']+1;
        }

        return $id;

    }

    function insertOrder($idorder, $idpelanggan, $tglorder, $total){
        global $db;
        $sql = "INSERT INTO tbl_order VALUES($idorder,$idpelanggan, '$tglorder', $total, 0,0,0)";
        //echo $sql;
        $db->runSql($sql);
    }

    function insertOrderDetail($idorder=1){
        global $db;
        
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'id_pelanggan' && $key<>'user' && $key<>'level' && $key<>'id_user') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tbl_menu WHERE id_menu= $id";
                // echo $sql;
                // echo '<br>';
                $row = $db->getAll($sql);
                foreach ($row as $key) {
                    $idmenu = $key['id_menu'];
                    $harga = $key['harga'];
                    $sql = "INSERT INTO tbl_order_detail VALUES('', $idorder, $idmenu, $value, $harga ) ";
                    // echo $sql;
                    $db->runSql($sql);
                }
                // echo '<pre>';
                // print_r($row);
                // echo '</pre>';
            }
        }


    }
    function kosongkanSession(){
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'id_pelanggan') {
                $id = substr($key,1);
                unset($_SESSION['_'.$id]);
            }
        }
    }

    function info(){
        echo'<h3>Terimakasih Sudah Berbelanja :) </h3>';
    }

?>