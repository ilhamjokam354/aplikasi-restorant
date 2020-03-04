<h1>Update Pelanggan</h1>

<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $row = $db->getItem("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = $id");
        //echo $row;
        if ($row['aktif']== 0) {
            $aktif = 1;
        }else {
            $aktif = 0;
        }
        
        $sql = "UPDATE tbl_pelanggan  SET aktif=$aktif WHERE id_pelanggan = $id";
        //echo $sql;
        $db->runSql($sql);
        header('location:?f=pelanggan&m=select');
    }

?>