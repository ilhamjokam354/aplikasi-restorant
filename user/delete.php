<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $db->runSql("DELETE FROM tbl_user WHERE id_user=$id");
        echo '<script>
        alert("User Berhasil di Hapus");
        document.location.href="?f=pelanggan&m=select";
        </script>';

    }
?>