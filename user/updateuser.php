<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_user WHERE id_user = $id";
        $row = $db->getItem($sql);

        
    }

?>

<h1>Update User</h1>
<div class="form-group">
    <form action="" method="post">
        <div class="form-group w-50">
            <label for="useri" >Username:</label>
            <input type="text" class="form-control" name="user" id="useri" value="<?php echo $row['user']?>" required> 
        </div>
        <div class="form-group w-50">
            <label for="email" >Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']?>" required> 
        </div>
        <div class="form-group w-50">
            <label for="password" >Password:</label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $row['password'];?>" required> 
        </div>
        <div class="form-group w-50">
            <label for="password2" >Konfirmasi Password:</label>
            <input type="password" class="form-control" name="password2" id="password2" value="<?php echo $row['password'];?>" required > 
        </div>
        <div class="form-group w-50">
            <label for="level" >Level:</label><br>
            <select name="level" id="">
                <option value="admin" <?php if($row['level']==="admin" ){ echo 'selected';}?>>admin</option>
                <option value="koki" <?php if($row['level']==="koki" ){ echo 'selected';}?>>koki</option>
                <option value="kasir" <?php if($row['level']==="kasir" ){ echo 'selected';}?>>kasir</option>
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
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $level = $_POST['level'];
    
        if ($password === $password2) {
            $sql = "UPDATE tbl_user SET user = '$user', email = '$email', password = '$password', level = '$level' WHERE id_user = $id";

           // echo $sql;
            $db->runSql($sql);
            header('location:?f=user&m=select');        
        }else {
            echo '<script>
            alert("Username Atau Password Salah");
            document.location.href="?f=user&m=insert";
            </script>';
        }
    

    
    }

?>