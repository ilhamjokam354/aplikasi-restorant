<h1>Registrasi</h1>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="pelanggan" >Pelanggan:</label>
            <input type="text" class="form-control" name="pelanggan" id="pelanggan" autofocus required> 
        </div>
        <div class="form-group w-50">
            <label for="alamat" >Alamat:</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required> 
        </div>
        <div class="form-group w-50">
            <label for="telepon" >Telepon:</label>
            <input type="text" class="form-control" name="telepon" id="telepon" required> 
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
        
        <div>
            <button type="submit" class="btn btn-sm btn-primary" name="simpan">Login</button>
        </div>
    </form>
</div>
 
<?php
    if (isset($_POST['simpan'])) {
    $pelanggan = $_POST['pelanggan'];
    $alamat = $_POST['alamat'];
    $telepon =  $_POST['telepon'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    
        if ($password === $password2) {
            $sql = "INSERT INTO tbl_pelanggan VALUES('', '$pelanggan', '$alamat', '$telepon', '$email', '$password', 1 )";
            //echo $sql;
            $db->runSql($sql);
            
            echo "<script>
            alert('Registrasi Berhasil Silahkan Login!');
            document.location.href='?f=home&m=login';
            </script>";
        }else {
            echo '<script>
            alert("Username Atau Password Salah");
            document.location.href="?f=home&m=daftar";
            </script>';
        }
    

    
    }

?>