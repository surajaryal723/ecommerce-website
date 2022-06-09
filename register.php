<?php include('partials-front/navbar.php');


?>

<div class="signup">
    <form action="" class="signup-form" method="POST">
    <?php
                if(isset($_SESSION['emailphone-taken'])){ //checking session set or not
                    echo $_SESSION['emailphone-taken']; //displaying session message
                    unset($_SESSION['emailphone-taken']);
                }
                
            ?>  <?php
                if(isset($_SESSION['add'])){ //checking session set or not
                    echo $_SESSION['add']; //displaying session message
                    unset($_SESSION['add']);
                }
                
            ?>

        <h1 id="signup-title">Signup</h1>

        <div>
            <img class="signup-img" src="images/user.png" alt="">
            <input class="signup-input" type="text" name="fullName" id="name" placeholder="Full Name" required>
        </div>
        <div>
            <img class="signup-img" src="images/phone.png" alt="">
            <input class="signup-input" type="text" name="contactNumber" id="" placeholder="Phone Number" required>
        </div>
        <div>
            <img class="signup-img" src="images/email.png" alt="">
            <input class="signup-input" type="email" name="email" id="" placeholder="Email" required>
        </div>
        <div>
            <img class="signup-img" src="images/password.png" alt="">
            <input class="signup-input" type="password" name="password" id="" placeholder="Password" required>
        </div>
        <div>
            <input class="signup-btn" type="submit" value="Sign Up" name="submit">
            
        </div>
        <div>
        <input class="reset-btn" type="reset" value="Reset">
        </div>
        <p class="signup-para">Already a user?<a href="login-user.php" class="signup-anch">Log In</a></p>
        

    </form>
</div>

<?php include('partials-front/footer.php');?>
<?php

if(isset($_POST['submit'])){

    // Get the data from the form
    $full_name=$_POST['fullName'];
    $contact=$_POST['contactNumber'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    //sql query to enter the data frm form to the database

    $sql2="SELECT * FROM tbl_user WHERE Contact='$contact' OR Email='$email'";
    $res2=mysqli_query($conn,$sql2);

    $count=mysqli_num_rows($res2);
    if($count==0){
        
        //  sql query to insert form data to the table 
        $sql="INSERT INTO tbl_user SET
        Fullname='$full_name',
        Contact='$contact',
        Email='$email',
        password='$password'
        ";
 

        // executing the query
        $res=mysqli_query($conn,$sql);

        if($res==TRUE){
            // creating a vaeriable to display message
            $_SESSION['signup-success']="<div  class='success'>You have been registered successfully.Please log in to proceed</div>";
            

            // redirecting
            header("location:".HOMEURL.'login-user.php');
        }
        else{
            // creating a vaeriable to display message
            $_SESSION['add']="<div class='error'>Signup Failed</div>";
            

            // redirecting
            header("location:".HOMEURL.'register.php');
        }

    }
    else{
        $_SESSION['emailphone-taken']="<div class='pwd-error'>Email or Phone number already registered</div>";
        header("location:".HOMEURL.'register.php');
    }
}    






?>
