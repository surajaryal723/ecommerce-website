<?php include('partials/navbar.php');?>
<h1>Update Status</h1>
<div class="main">
   <div>
       <?php
       if(isset($_GET['order_id'])){
           $order_id=$_GET['order_id'];

           $sql="SELECT status FROM tbl_order WHERE order_id=$order_id";
           $res=mysqli_query($conn,$sql);
           if($res==true){
               $count=mysqli_num_rows($res);
               if($count==1){
                   $row=mysqli_fetch_assoc($res);
                    $status=$row['status'];
               }
           }
       }
       else{
           header("location:".HOMEURL.'admin/manage-order.php');
       }
       ?>
       <form style="margin:20px; padding:20px;"action="" method="POST">
           <div>
               
               <label class="admin-input-label" for="name">Status</label>
               <select name="status">
                    <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                    <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                    <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                    <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                </select>
            </div>
            <input type="hidden" name="" value="<?php echo $order_id;?>">
            <input type="submit" name="submit" value="Update Status" style="margin-top:30px; margin-left:10px; padding: 5px;" >
            
        </form>
        <?php
        
        if(isset($_POST['submit'])){
            
            $status=$_POST['status'];

            $sql2="UPDATE tbl_order SET status='$status' WHERE order_id=$order_id";
            $res2=mysqli_query($conn,$sql2);
            if($res2==true){
                $_SESSION['update'] = "<div class='success'>Status Updated Successfully.</div>";
                header('location:'.HOMEURL.'admin/manage-order.php');
            }
            else
            {
                
                $_SESSION['update'] = "<div class='error'>Failed to Update Status.</div>";
                header('location:'.HOMEURL.'admin/manage-order.php');
            }
        }
        ?>
</div>
<?php include('partials/footer.php');?>