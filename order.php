<?php
ob_start();
include('partials-front/navbar.php');
include('partials-front/login-check-user.php');
?>
<div class="order-container">
    <div class="order-form">
        <form action="" class="order" method="POST">
            <?php
            $sql3="SELECT * FROM tbl_user WHERE Email='".$_SESSION['email']."'";
            $res3=mysqli_query($conn,$sql3);
            $count3=mysqli_num_rows($res3);
            if($count3==1){
                $row3=mysqli_fetch_assoc($res3);
                $user_id=$row3['user_id'];
                $email=$row3['Email'];
                $full_name=$row3['Fullname'];
                $contact=$row3['Contact'];
                
            }
            ?>
            <h2 class="order-title">Place your order here</h2>
            <?php
            
           
            
            if(isset($_GET['product_id'])){
                $product_id=$_GET['product_id'];
                
                $sql="SELECT * FROM tbl_product WHERE product_id=$product_id";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count==1){
                    while($rows=mysqli_fetch_assoc($res)){
                        $title=$rows['title'];
                        $description=$rows['description'];
                        $price=$rows['price'];
                        $image_name=$rows['image_name'];
                        ?>
                            <div class="order-upper">
                                <?php
                                    if($image_name!=""){
                                        ?>
                                            <img src="<?php echo HOMEURL;?>images/products/<?php echo $image_name;?>" alt="" class="order-image"></a>
                                        
                                            <?php
                                    }
                                    else{
                                        echo "<div class='error'>Product image not added</div>";
                                    }
                                ?>
                                
                                <div class="product-order-desc">
                                    <h3 style="margin-bottom:20px;"><?php echo $title;?></h3>
                                    <input type="hidden" name="title" value="<?php echo $title;?>">
                                    <p class="product-price">₹<?php echo $price;?></p>
                                    <input type="hidden" name="price" value="<?php echo $price;?>">
                                    <div class="order-label">Quantity</div>
                                    <input type="number" name="qty" class="input-responsive" value="1" required min="1">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
                                </div>
                            </div>
                        
                             <div class="order-lower">
                                <input type="hidden" name="full_name" id="" value="<?php echo $full_name;?>">
                                <input type="hidden" name="email" id="" value="<?php echo $email;?>">
                                <input type="hidden" name="contact" id="" value="<?php echo $contact;?>">
                                <input type="hidden" name="user_id" id="" value="<?php echo $user_id;?>">
                                <div>
                                    <label for="addr">Address<sup class="required">*</sup></label>
                                    <textarea name="address" id="addr" cols="70" rows="10" placeholder="Street NO,city,state"
                                        required></textarea>
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Confirm Order" class="order-btn" >
                     <?php           
                    }
                }
                
            }
            else{
                header("location:".HOMEURL);
            }
            ?>
        </form>
         <?php
            if(isset($_POST['submit'])){
                $product_id=$_POST['product_id'];
                $user_id=$_POST['user_id'];
                $customer_name=$_POST['full_name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $product_name=$_POST['title'];
                $price=$_POST['price'];
                $quantity=$_POST['qty'];
                $total=$price*$quantity;
                $order_date=date("Y-m-d h:i:sa");
                $status="Ordered";
                $address=$_POST['address'];

                
              $sql2="INSERT INTO tbl_order SET
               product_id=$product_id,
               user_id=$user_id,
               customer_name='$customer_name',
               customer_email='$customer_email',
               customer_contact='$customer_contact',
               product_name='$product_name',
               price=$price,
               quantity=$quantity,
               total=$total,
               order_date='$order_date',
               status='$status',
               address='$address'
               ";
              $res2=mysqli_query($conn,$sql2);
              if($res2==true){
                  $_SESSION['order-success']="<div class='success'>Order successful.Thank you for choosing us!</div>";
                  header("location:".HOMEURL);
                  ob_end_flush();
              }
              else{
                  echo "failed";
              }
            }
            ?>
</div>
</div>
<?php include('partials-front/footer.php');?>
              
                
           
            
