<?php include('partials/navbar.php');?>

<h1>Update Admin</h1>

<?php

$admin_id=$_GET['admin_id'];

$sql="SELECT * FROM tbl_admin WHERE admin_id=$admin_id";

$res=mysqli_query($conn,$sql);

if($res==TRUE){
    $count=mysqli_num_rows($res);
    if($count==1){
        $rows=mysqli_fetch_assoc($res);
        
        $full_name=$rows['full_name'];
        $username=$rows['username'];
    }
    else{
        header("location:".HOMEURL.'admin/manage-admin.php');
    }
}


?>

<div class="main">
   <div>
       <form class="admin-input-form" action="" method="POST">
           <div>
               <label class="admin-input-label" for="name">Full Name</label>
               <input class="admin-input" type="text" name="full-name" id="name" placeholder="Full Name" value="<?php echo $full_name;?>" required>
            </div>
            <div>
                
                <label class="admin-input-label" for="username">Username</label>
                <input class="admin-input" type="text" name="username" id="username" placeholder="Username" value="<?php echo $username;?>" required>
            </div>
            <div>
                <input type="hidden" name= "admin_id" value="<?php echo $admin_id;?>">
            </div>
           
            <input type="submit" name="submit" value="Update Admin" class="btn-add-admin">
        </div>
    </form>
</div>

<?php

if(isset($_POST['submit'])){
   
     $admin_id=$_POST['admin_id'];
     $full_name=$_POST['full-name'];
     $username=$_POST['username'];

     //updating the list query
      
        $sql="UPDATE  tbl_admin SET
      
        full_name='$full_name',
        username='$username'

        WHERE admin_id='$admin_id'
        ";


        $res=mysqli_query($conn,$sql);;

        if($res==TRUE){
            // creating a vaeriable to display message
            $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
            
    
            // redirecting
            header("location:".HOMEURL.'admin/manage-admin.php');
        }
        else{
             // creating a vaeriable to display message
             $_SESSION['update']="<div class='error'>Failed to update admin</div>";
            
    
             // redirecting
             header("location:".HOMEURL.'admin/manage-admin.php');
        }
        
        
    
       

}
?>
<?php include('partials/footer.php');?>