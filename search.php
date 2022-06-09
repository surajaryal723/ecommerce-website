<?php include('partials-front/navbar.php');?>
<div class="featured">
    <?php

        $search=$_POST['search'];
        
        $sql="SELECT * FROM tbl_product WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        if($count>0){
            while($rows=mysqli_fetch_assoc($res)){
                $product_id=$rows['product_id'];
                $title=$rows['title'];
                $description=$rows['description'];
                $price=$rows['price'];
                $image_name=$rows['image_name'];
                $category_id=$rows['category_id'];
                ?>
                    
                        <div class="box-6">
                            <?php
                                if($image_name!=""){
                                    ?>

                                    <img src="<?php echo HOMEURL;?>images/product/<?php echo $image_name;?>" alt="" class="feature-img">
                                    <?php
                                }
                                else{
                                    echo "<div class='error'>Category image not added</div>";
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
            echo "<div class='error'>Product not found!</div>";
        }

    ?>

    
</div>
<?php include('partials-front/footer.php');?>