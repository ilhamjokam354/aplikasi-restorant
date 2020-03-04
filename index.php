<?php


    session_start();
    require_once 'dbcontroller.php';
    $db = new DB;

    $sql = "SELECT * FROM tbl_kategori ORDER BY kategori";

    $all = $db->getAll($sql);

    //var_dump($all);
    if (isset($_GET['log'])) {
        session_destroy();
        header('location:index.php');


    }

    function cart(){
        global $db;
        $cart = 0;
        //var_dump($_SESSION);    
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'id_pelanggan' && $key<>'user' && $key<>'level' && $key<>'id_user'){
                $id = substr($key,1);
                $sql = "SELECT * FROM tbl_menu WHERE id_menu= $id";
                // echo $sql;
                // echo '<br>';
                $row = $db->getAll($sql);
                foreach ($row as $key) {
                   $cart++;
                }
                // echo '<pre>';
                // print_r($row);
                // echo '</pre>';
            }
        }
        return $cart;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurant  Page | Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>

    <div class="container">
        <div class="row ">
            <div class="col md-3 mb-3">
                <h1><a href="index.php">Restoran</a></h1>
            </div>
            
            <div class="col-md-9">
                <?php 
                    if (isset($_SESSION['pelanggan'])) {
                        echo '
                            <a href="?log=logout" class="float-right mt-4 btn btn-sm btn-danger ">Logout </a>        
                            <div class="float-right mt-4 mr-4 ">Pelanggan : '.$_SESSION['pelanggan'].' </a></div>
                            <div class="float-right mt-4 mr-4 ">Cart (<a href="?f=home&m=beli">'.cart().'</a>)</div>
                            <a href="?f=home&m=histori" class="float-right mt-4 mr-4 btn btn-sm btn-warning ">History </a>        
                        ';
                    }else {
                        echo'
                            <a href="?f=home&m=login" class="float-right mt-4 mr-4 btn btn-sm btn-primary " role="button">Login  </a>
                    
                            <a href="?f=home&m=daftar" role="button" class="float-right mt-4 mr-4 btn btn-sm btn-danger ">Daftar </a>        
                        ';
                    }
                ?>

                
                
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <h3>Kategori</h3>
                <hr>
                <?php if(!empty($all)){?>
                <ul class="nav flex-column">
                    <?php foreach($all as $key):?>
                        
                    <li class="nav-item"><a href="?f=home&m=produk&id=<?php echo $key['id_kategori'];?>" class="nav-link"><?php echo $key['kategori']; ?></a></li>
                    <?php endforeach ?>
                </ul>
                
                <?php }?>
            </div>

            <div class="col-md-9  ">
                    
                <?php
                    if (isset($_GET['f']) && isset($_GET['m'])) {
                        $f = $_GET['f'] ; //menuju ke folder
                        $m = $_GET['m']; //menuju ke file

                        $file = $f.'/'.$m.'.php';
                        require_once $file;
                    }else {
                        require_once 'home/produk.php';
                    }                
                
                ?>
            </div>
        </div>
    
        <div class="row mt-5 ">
            <div class="col">
                <p class="text-center" >2020 Copyright@ilham.com</p>
            </div>
        
        </div>
    </div>
    
</body>
</html>