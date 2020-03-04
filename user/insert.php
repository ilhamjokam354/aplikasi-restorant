<h1>Tambah Data</h1>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="useri" >Username:</label>
            <input type="text" class="form-control" name="user" autofocus id="useri" required> 
        </div>
        <div class="form-group w-50">
            <label for="email" >Email:</label>
            <input type="email" class="form-control" name="email" id="email" required> 
        </div>
        <div class="form-group w-50">
            <label for="password" >Password:</label>
            <input type="password" class="form-control" name="password" id="password" required> 
        </div>
        <div class="form-group w-50">
            <label for="password2" >Konfirmasi Password:</label>
            <input type="password" class="form-control" name="password2" id="password2" required > 
        </div>
        <div class="form-group w-50">
            <label for="level" >Level:</label><br>
            <select name="level" id="">
                <option value="admin">admin</option>
                <option value="koki">koki</option>
                <option value="kasir">kasir</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Simpan</button>
        </div>
    </form>
</div>
 
<?php
    if (isset($_POST['simpan'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $password2 = hash('sha256', $_POST['password2']);
    $level = $_POST['level'];
    
        if ($password === $password2) {
            $sql = "INSERT INTO tbl_user VALUES('', '$user', '$email', '$password', '$level', 1 )";
            //echo $sql;
            $db->runSql($sql);
            echo '<script>
            alert("User Berhasil di Tambah");
            document.location.href="?f=pelanggan&m=select";
            </script>';
        }else {
            echo '<script>
            alert("Cek Data Kembali");
            document.location.href="?f=user&m=insert";
            </script>';
        }
    

    
    }

?>