<?php
    session_start();
    require_once '../dbcontroller.php';
    $db = new DB;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
    <style>
            body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
            }

            .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
            margin-bottom: 10px;
            }
            .form-signin .checkbox {
            font-weight: normal;
            }
            .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                    box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
            }
            .form-signin .form-control:focus {
            z-index: 2;
            }
            .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            }

    </style>
<body>
            <div class="container">

            <form class="form-signin" action="" method="post">
            <h2 class="form-signin-heading">Login Restaurant </h2>
            <label for="inputEmail" ><h5>Email:</h5> </label><br>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email " required autofocus>
            <label for="inputPassword" ><h5>Password:</h5></label><br>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
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
        $password = hash('sha256', $_POST['password']);
        
        $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND password ='$password'";
        $count = $db->rowCount($sql);
        
        if ($count == 0) {
            echo '<script>
            alert("Username Atau Password Salah");
            </script>';
        }else {
            $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
            $row = $db->getItem($sql);

            $_SESSION['user']=$row['email'];
            $_SESSION['level']=$row['level'];
            $_SESSION['iduser']=$row['id_user'];

            header('location:index.php');

        }
    }
?>