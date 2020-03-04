<h1>Delete</h1>
<?php
    if (isset($_GET['id'])) {
       
        $id = $_GET['id'];
        
        $sql = "DELETE FROM tbl_kategori WHERE id_kategori = $id";

        
        $db->runSql($sql);
       
        header('location:?f=kategori&m=select');
    }


?>