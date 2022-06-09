<?php include('partials-front/navbar.php'); ?>


                    <?php        
                        if(isset($_SESSION['login-success'])){ //checking session set or not
                            echo $_SESSION['login-success']; //displaying session message
                            unset($_SESSION['login-success']); //closing the session
                        }
                    ?>    <?php        
                        if(isset($_SESSION['order-success'])){ 
                            echo $_SESSION['order-success']; 
                            unset($_SESSION['order-success']); 
                        }
                    ?> 

<?php


?>
    <h1 class="title">Categories</h1>
    <div class="categories">
         <?php
        //query to display all the categories from database
        $sql="SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes'";
        $res=mysqli_query($conn,$sql);
        if($res==true){
            $count=mysqli_num_rows($res);
            if($count>0){
                while($rows=mysqli_fetch_assoc($res)){
                    $category_id=$rows['category_id'];
                    $title=$rows['title'];
                    $image_name=$rows['image_name'];

                    ?>

                                <div class="box-4">
                                    <a href="<?php echo HOMEURL;?>category-products.php?category_id=<?php echo $category_id;?>" class="category-img">
                                        <?php
                                            if($image_name!=""){
                                                ?>

                                                    <img src="<?php echo HOMEURL;?>images/category/<?php echo $image_name;?>" alt="" class="category-image"></a>
                                                
                                                    <?php
                                            }
                                            else{
                                                echo "<div class='error'>Category image not added</div>";
                                            }
                                        
                                        ?>
                                    <a class="nav-item" href="<?php echo $title;?>.php">
                                        <h3><?php echo $title;?></h3>
                                    </a>
                                </div>
                            
                                <?php
                }

            }
            else{
                echo "<div class='error'>Not any active and featured categories added</div>";
            }
        }
        ?>
    </div>
    
    <h1 class="title">Featured Products</h1>
    <div class="featured">
        <?php
            $sql2="SELECT * FROM tbl_product WHERE featured='Yes' AND active='Yes'";
            $res2=mysqli_query($conn,$sql2);
            $count2=mysqli_num_rows($res2);
            if($count2>0){
                while($rows2=mysqli_fetch_assoc($res2)){
                    $product_id=$rows2['product_id'];
                    $title=$rows2['title'];
                    $description=$rows2['description'];
                    $price=$rows2['price'];
                    $image_name=$rows2['image_name'];
                    $category_id=$rows2['category_id'];
                    ?>
                        
                            <div class="box-6">
                                <?php
                                    if($image_name!=""){
                                        ?>

                                        <img src="<?php echo HOMEURL;?>images/product/<?php echo $image_name;?>" alt="" class="feature-img">
                                        <?php
                                    }
                                    else{
                                        echo "<div class='error'>Product image not added</div>";
                                    }
                                ?>
                                <div class="feature-desc">
                                    <h3><?php echo $title;?></h3><br>
                                    <p class="product-price">₹&nbsp;<?php echo $price;?></p><br>
                                    <p class="product-desc"><?php echo $description;?></p><br><br>
                                    <a href="<?php echo HOMEURL;?>order.php?product_id=<?php echo $product_id;?>" class="order-feature-btn">Buy Now</a>
                                </div>

                            </div>
            
                        

                    <?php
                }
            }
            else{
                echo "<div class='error'>Not any active and featured products added</div>";
            }
        ?>

        
    </div>

    <?php include('partials-front/footer.php');?>
