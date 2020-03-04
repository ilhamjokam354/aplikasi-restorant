<?php
    if (isset($_GET['id'])) {
       
        $id = $_GET['id'];
        
        $sql = "DELETE FROM tbl_menu WHERE id_menu = $id";

        
        $db->runSql($sql);
       
        header('location:?f=menu&m=select');
    }


?>