<?php
    include 'C:\xampp\htdocs\ROP\connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="login-form">
        <form method="POST" autocomplete="off">
            <span class="logo">
                <img src="/ROP/admin_site/media/admin.png" alt="">
            </span>

            <span class="login-name">
                Log in
            </span>
            
            <div class="username">
                <i class="fa fa-user" aria-hidden="true"></i>
                <div class="wrapper">
                    <input class="input" type="text" name="adminName" placeholder="Username">
                    <span class="focus-input"></span>
                </div>
            </div>

            <div class="password">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <div class="wrapper">
                    <input class="input" type="password" name="adminPassword" placeholder="Password">
                    <span class="focus-input"></span>
                </div>
            </div>

            <div class="login">
                <button name="Login">Login</button>
            </div>
            

        </form>
    </div>
	
    <?php
        if(isset($_POST['Login'])){  
            $query = ("SELECT * FROM admin WHERE admin_name = '$_POST[adminName]' AND admin_password = '$_POST[adminPassword]'");
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result)==1){
                session_start();
                $_SESSION['AdminLoginId'] = $_POST['adminName'];
                header("location: admin.php");
            }
            else {
                echo "<script>alert('Nesprávne heslo');</script>";
            }
            
        }
    ?>
	
</body>
</html>