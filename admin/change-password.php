<?php include('partials/navbar.php')?>


<h1>Change Password</h1>
            <?php
             if(isset($_SESSION['pwd-no-match'])){ //checking session set or not
                echo $_SESSION['pwd-no-match']; //displaying session message
                unset($_SESSION['pwd-no-match']); //closing the session
            }
            ?>
            
           

<?php

if(isset($_GET['admin_id'])){
    $admin_id=$_GET['admin_id'];
}
?>

<div class="main">
   <div>
       <form class="admin-input-form" action="" method="POST">
           <div>
               <label class="admin-input-label" for="cur_password">Current Password</label>
               <input class="admin-input" type="password" name="current_password" id="cur_password" placeholder="Current Password"  required>
            </div>
            <div>
                
                <label class="admin-input-label" for="new_pass">New Password</label>
                <input style="margin-left:20px;" class="admin-input" type="password" name="new_password" id="new_pass" placeholder="New Password" required>
            </div> <div>
                
                <label class="admin-input-label" for="con_pass">Confirm Password</label>
                <input class="admin-input" type="password" name="confirm_password" id="con_pass" placeholder="Confirm Password" required>
            </div>
            <div>
                <input type="hidden" name= "admin_id" value="<?php echo $admin_id;?>">
            </div>
           
            <input type="submit" name="submit" value="Change Password" class="btn-add-admin">
        </div>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    $admin_id=$_POST['admin_id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    $sql="SELECT * FROM tbl_admin WHERE admin_id=$admin_id AND password='$current_password'";

    $res=mysqli_query($conn,$sql);

    if($res==TRUE)
    {
        
        $count=mysqli_num_rows($res);
        if($count==1)
        {
           
          if($new_password==$confirm_password)
          {
            $sql2="UPDATE tbl_admin SET
            password='$new_password'
            WHERE admin_id=$admin_id
            ";

            $res2=mysqli_query($conn,$sql2);

            if($res2==TRUE){
                $_SESSION['pwd-match']="<div class='success'>Password Changed successfully</div>";
                header("location:".HOMEURL.'admin/manage-admin.php');

            }
            else{
                $_SESSION['pwd-no-match']="<div class='pwd-error'>Password Did Not Match</div>";
                header("location:".HOMEURL.'admin/change-password.php');
            }

          }
           else{
            $_SESSION['pwd-no-match']="<div class='pwd-error'>Password Did Not Match</div>";
                header("location:".HOMEURL.'admin/change-password.php');
           }
        }
        else
        {
            $_SESSION['not-found']="<div class='error'>User Not Found</div>";
            header("location:".HOMEURL.'admin/manage-admin.php');
        }
    }
}

?>

<?php include('partials/footer.php')?>


