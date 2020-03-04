<h2>MENU PELANGGAN</h2>
  <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $where = "WHERE id_kategori = $id";
        $id = '&id='.$id;
    }else {
        $where = "";
        $id = "";
    }
  ?> 
    <div class="mt-4 mb-4">
        <?php 
            $row = $db->getAll("SELECT * FROM tbl_kategori ORDER BY kategori ASC");
        ?>

        
    </div>
<?php
   
    $jumlahdata = $db->rowCount("SELECT id_menu FROM tbl_menu $where ");
    $banyak = 3 ;

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        //echo $p;
        $mulai = ($p * $banyak) - $banyak;
    }else {
        $mulai = 0;
    }

    $halaman = ceil($jumlahdata / $banyak);
    $sql = "SELECT * FROM tbl_menu $where ORDER BY menu ASC LIMIT $mulai, $banyak";

    $row = $db->getAll($sql);
    
    //var_dump($row);

    $no = 1+$mulai;
?>

     
        <?php if(!empty($row)){?>
        <?php foreach ($row as $key ):?>
            <div class="card" style="width: 15rem; float:left; margin:10px">
                <img style="height:150px " src="upload/<?php echo $key['gambar'];?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $key['menu'];?></h5>
                    
                    <p class="card-text"><h7 class="card-title">Harga : <?php echo $key['harga'];?></h7></p>
                    <a href="?f=home&m=beli&id=<?php echo $key['id_menu'];?> " class="btn btn-primary" role="button" >Beli</a>
                </div>
            </div>

        
        <?php endforeach ?>
        <?php }?>
    
    <div style="clear:both;"> 
<?php
    for ($i=1; $i <= $halaman ; $i++) { 
        echo '<a   href ="?f=home&m=produk&p='.$i.$id.'" >'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?> 
    </div>