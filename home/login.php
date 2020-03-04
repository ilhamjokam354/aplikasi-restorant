<link rel="stylesheet" href="css_login.css">
     <div class="container">

            <form class="form-signin" action="" method="post">
                <h2 class="form-signin-heading">Login Pelanggan </h2>
                <label for="inputEmail" ><h5>Email:</h5> </label><br>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email " autofocus required autofocus>
                <label for="inputPassword" ><h5>Password:</h5></label><br>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required><br>
                <!-- <div class="checkbox">
                    <label>
                    <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div> -->
                <button class="btn btn-lg btn-primary btn-block" name="login" >Login</button>
            </form>

        </div> <!-- /container -->

</body>
</html>

<?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM tbl_pelanggan WHERE email = '$email' AND password ='$password' AND aktif = 1";
        $count = $db->rowCount($sql);
        // echo $count;
        
        if ($count == 0) {
            echo '<script>
            alert("Email Belum Terdaftar Atau Password Salah");
            document.location.href="?f=home&m=login";
            </script>';
        }else {
            $sql = "SELECT * FROM tbl_pelanggan WHERE email = '$email' AND password ='$password' AND aktif = 1";
            $row = $db->getItem($sql);

            $_SESSION['pelanggan']=$row['email']; 
            $_SESSION['id_pelanggan']=$row['id_pelanggan'];

            header('location:index.php');

        }
    }
?> 