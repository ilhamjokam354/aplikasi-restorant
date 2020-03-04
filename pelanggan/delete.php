<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $db->runSql("DELETE FROM tbl_pelanggan WHERE id_pelanggan =$id");

        header('location:?f=pelanggan&m=select');
    }


?>