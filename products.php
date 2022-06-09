<?php include('partials-front/navbar.php');?>
<div class="featured">
        <?php
            $sql2="SELECT * FROM tbl_product WHERE active='Yes'";
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
                echo "<div class='error'>Products not added</div>";
            }
        ?>

        
    </div>
<?php include('partials-front/footer.php');?>