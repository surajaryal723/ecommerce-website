<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>admin-login</title>
</head>

<body>
    <?php include('../config/constants.php');?>

    <div class="main">
        <h1>Log In</h1>
        <?php
             if(isset($_SESSION['login-error'])){ //checking session set or not
                echo $_SESSION['login-error']; //displaying session message
                unset($_SESSION['login-error']); //closing the session
            }
            ?>  
             <?php
             if(isset($_SESSION['login-message'])){ //checking session set or not
                echo $_SESSION['login-message']; //displaying session message
                
            }
            ?>
        <form class="admin-input-form" action="" method="POST">
            <div>

                <label class="admin-input-label" for="username">Username</label>
                <input class="admin-input" type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div>

                <label class="admin-input-label" for="password">Password</label>
                <input class="admin-input" type="password" name="password" id="password" placeholder="Password"
                    required>
            </div>
            <div>
                <input type="submit" name="submit" value="Log In" class="btn-add-admin">
            </div>


        </form>
    </div>

</body>

<?php

if(isset($_POST['submit'])){
     $username=$_POST['username'];
    $password=md5($_POST['password']);

    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res=mysqli_query($conn,$sql);

    $count=mysqli_num_rows($res);

    if($count==1){
        $_SESSION['login-success']="<div class='success'>Logged In Successfully</div>";
        header("location:".HOMEURL.'admin/');
        $_SESSION['user']=$username;

    }
    else{
        $_SESSION['login-error']="<div class='pwd-error'>Username or Password Did Not Match</div>";
        header("location:".HOMEURL.'admin/login-admin.php');
    }
}

?>

</html>