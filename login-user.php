<?php include('partials-front/navbar.php');

?>

<div class="login">
    <form action="" class="login-form" method="POST">
    <?php
             if(isset($_SESSION['user-login-error'])){ //checking session set or not
                echo $_SESSION['user-login-error']; //displaying session message
                unset($_SESSION['user-login-error']); //closing the session
            }
        ?>
        <?php        
                        if(isset($_SESSION['signup-success'])){ //checking session set or not
                            echo $_SESSION['signup-success']; //displaying session message
                            unset($_SESSION['signup-success']); //closing the session
                        }
                    ?><?php        
                        if(isset($_SESSION['login-message'])){ //checking session set or not
                            echo $_SESSION['login-message']; //displaying session message
                            unset($_SESSION['login-message']); //closing the session
                        }
                    ?>
        <h1 class="login-title">Log In</h1>

        <div>
            <input class="signup-input" type="email" name="email" id="" placeholder="Email" required>
        </div>
        <div>
            
            <input class="signup-input" type="password" name="password" id="" placeholder="Password" required>
        </div>
        <div>
            <input class="login-btn" type="submit" value="Log In" name="submit">
            
        </div>
        <div>
        <input class="reset-btn" type="reset" value="Reset">
        </div>
        <p class="signup-para">Not Registered Yet?<a href="register.php" class="signup-anch">Sign Up</a></p>
    </form>
</div>  
<?php include('partials-front/footer.php');?>
<?php

if(isset($_POST['submit'])){
     $email=$_POST['email'];
    $password=md5($_POST['password']);

    $sql="SELECT * FROM tbl_user WHERE Email='$email' AND password='$password'";

    $res=mysqli_query($conn,$sql);

    $count=mysqli_num_rows($res);

    if($count==1){
        $_SESSION['login-success']="<div style='text-align:center; color:green; font-size:1.5rem;' class='success'>Logged In Successfully</div>";
        header("location:".HOMEURL);
        $_SESSION['email']=$email;
       
        

    }
    else{
        $_SESSION['user-login-error']="<div class='pwd-error'>Email or Password Did Not Match</div>";
        header("location:".HOMEURL.'login-user.php');
    }
}

?>
