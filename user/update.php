
<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $row = $db->getItem("SELECT * FROM tbl_user WHERE id_user = $id");
        //echo $row;
        if ($row['aktif']== 0) {
            $aktif = 1;
        }else {
            $aktif = 0;
        }
        
        $sql = "UPDATE tbl_user  SET aktif=$aktif WHERE id_user = $id";
        //echo $sql;
        $db->runSql($sql);
        echo '<script>
        alert("Pelanggan Berhasil di Update");
        document.location.href="?f=user&m=select";
        </script>';
    }

?>