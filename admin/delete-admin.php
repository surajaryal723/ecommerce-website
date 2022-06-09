<?php

include('../config/constants.php');

$admin_id=$_GET['admin_id']; //grtting admin id

$sql="DELETE FROM tbl_admin WHERE admin_id=$admin_id"; //query to delete 

$res=mysqli_query($conn,$sql); //executing the query

if($res==TRUE){
    $_SESSION['delete']="<div class='success'>Admin deleted Successfully</div>";
    header("location:".HOMEURL.'admin/manage-admin.php');
}
else{
    $_SESSION['delete']="<div class='error'>Failed to delete Admin</div>";
    header("location:".HOMEURL.'admin/manage-admin.php');
}


?>