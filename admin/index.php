<?php
    session_start();
    require_once '../dbcontroller.php';
    $db = new DB;

    if (!isset($_SESSION['user'])) {
        header('location:login.php');
    }

    if (isset($_GET['log'])) {
        session_destroy();
        header('location:login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page | Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>

    <div class="container ">
        <div class="row ">
            <div class="col md-3 mt-4">
                <h2><a href="index.php">Admin Page</a></h2>
            </div>
            
            <div class="col-md-9">
                <a class="float-right mt-4 btn btn-sm btn-danger "  href='?log=logout'> Logout</a>
                <div class="float-right mt-4 mr-4 ">User : <a href="?f=user&m=updateuser&id=<?php echo $_SESSION['iduser'];?>"><?php echo $_SESSION['user'];?></a></div>
                <div class="float-right mt-4 mr-4 ">Level : <?php echo $_SESSION['level'];?></div>
                
            </div>

        </div>

        <div class="row">
            <div class="col-md-3 mt-5">
                <ul class="nav flex-column">
                <?php  
                
                    $level = $_SESSION['level'];

                    switch ($level) {
                        case 'admin':
                            echo '
                                <li class="nav-item"><a href="?f=kategori&m=select" class="nav-link"> Kategori</a></li>
                                <li class="nav-item"><a href="?f=menu&m=select" class="nav-link">Menu</a></li>
                                <li class="nav-item"><a href="?f=pelanggan&m=select" class="nav-link">Pelanggan</a></li>
                                <li class="nav-item"><a href="?f=order&m=select" class="nav-link">Order</a></li>
                                <li class="nav-item"><a href="?f=order_detail&m=select" class="nav-link">Order-Detail</a></li>
                                <li class="nav-item"><a href="?f=user&m=select" class="nav-link">User</a></li>

                            ';
                            break;

                        case 'kasir':
                                echo '
                                <li class="nav-item"><a href="?f=order&m=select" class="nav-link">Order</a></li>
                                <li class="nav-item"><a href="?f=order_detail&m=select" class="nav-link">Order-Detail</a></li>
                                ';
                            break;
                            
                        case 'koki':
                                echo '
                                <li class="nav-item"><a href="?f=order_detail&m=select" class="nav-link">Order-Detail</a></li>
                                ';
                            break;
                        
                        default:
                            echo 'Tidak Ada Menu';
                            break;
                    }
                
                ?>
                    
                </ul>
            </div>

            <div class="col-md-9">
                <?php
                    if (isset($_GET['f']) && isset($_GET['m'])) {
                        $f= $_GET['f'];
                        $m= $_GET['m'];

                        $file = '../'.$f.'/'.$m.'.php';

                        require_once $file  ;
                    }
                
                
                ?>
            </div>
        </div>
    
        <div class="row mt-5">
            <div class="col">
                <p class="text-center"> 2020 - Copyright@Ilhamimam.com</p>
            </div>
        
        </div>
    </div>
    
</body>
</html>