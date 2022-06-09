<?php include('partials-front/navbar.php');


?>





<div class="categories">
         <?php
        //query to display all the categories from database
        $sql="SELECT * FROM tbl_category WHERE active='Yes'";
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
                                    <a href="<?php echo HOMEURL;?>category-products.php?category_id=<?php echo $category_id;?>"" class="category-img">
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
                echo "<div class='error'>Category not added</div>";
            }
        }
        ?>
    </div>
<?php include('partials-front/footer.php');?>