<?php include('partials/navbar.php')?>

<h1>Add Admin</h1>

        <?php
             if(isset($_SESSION['username-taken'])){ //checking session set or not
                echo $_SESSION['username-taken']; //displaying session message
                unset($_SESSION['username-taken']);
                
            }
        ?>    
<div class="main">
    <div>
        <form class="admin-input-form" action="" method="POST">
            <div>
                <label class="admin-input-label" for="name">Full Name</label>
                <input class="admin-input" type="text" name="full-name" id="name" placeholder="Full Name" required>
            </div>
            <div>

                <label class="admin-input-label" for="username">Username</label>
                <input class="admin-input" type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div>

                <label class="admin-input-label" for="password">Password</label>
                <input class="admin-input" type="password" name="password" id="password" placeholder="Password"
                    required>
            </div>
            <input type="submit" name="submit" value="Add Admin" class="btn-add-admin">
        </form>
    </div>
</div>
<?php include('partials/footer.php')?>

<?php
// process the form to submit data in database
    if(isset($_POST['submit'])){
    // get the data from form
     $full_name=$_POST['full-name'];
     $username=$_POST['username'];
     $password=md5($_POST['password']);

        $sql2="SELECT * FROM tbl_admin WHERE username='$username'";
        $res2=mysqli_query($conn,$sql2);

        $count=mysqli_num_rows($res2);
        if($count==0){
            
            //  sql query to insert form data to the table 
            $sql="INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
            ";
     
    
            // executing the query
            $res=mysqli_query($conn,$sql) or die(mysqli_error());

            if($res==TRUE){
                // creating a vaeriable to display message
                $_SESSION['add']="<div class='success'>Admin added successfully</div>";
                

                // redirecting
                header("location:".HOMEURL.'admin/manage-admin.php');
            }
            else{
                // creating a vaeriable to display message
                $_SESSION['add']="<div class='error'>Failed to add admin</div>";
                

                // redirecting
                header("location:".HOMEURL.'admin/manage-admin.php');
            }

        }
        else{
            $_SESSION['username-taken']="<div class='pwd-error'>Username already taken</div>";
            header("location:".HOMEURL.'admin/add-admin.php');
        }
    }    
   
    
    


?>