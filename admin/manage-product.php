<?php include('partials/navbar.php')?>
<div class="main">
            <h2>Manage Product</h2>
            <?php
             if(isset($_SESSION['add'])){ //checking session set or not
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //closing the session
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-product-found']))
            {
                echo $_SESSION['no-product-found'];
                unset($_SESSION['no-product-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            ?>
            <a href="<?php echo HOMEURL;?>admin/add-product.php" class="btn-add-admin">Add Product</a>
            <a href="<?php echo HOMEURL;?>admin/trigger.php" class="btn-add-admin">View History</a>
            <div class="admin-table">
                <table>
                    <tr>
                        <th>Product ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category_id</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>

                    </tr>
                    <?php 

                        $sql="SELECT * FROM tbl_product";
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
                                $featured=$rows['featured'];
                                $active=$rows['active'];
                                ?>
                                    <tr>
                                        <td><?php echo $product_id;?></td>
                                        <td><?php echo $title;?></td>
                                        <td><?php echo $description;?></td>
                                        <td><?php echo $price;?></td>
                                        <td>
                                            
                                            <?php  
                                                    
                                                    if($image_name!="")
                                                    {
                                                        
                                                        ?>
                                                        
                                                        <img src="<?php echo HOMEURL; ?>images/product/<?php echo $image_name; ?>" width="100px" >
                                                        
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        
                                                        echo "<div class='pwd-error'>Image not Added.</div>";
                                                    }
                                                ?>
                                        </td>
                                        <td><?php echo $category_id;?></td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        
                                        <td><a href="<?php echo HOMEURL;?>admin/update-product.php?product_id=<?php echo $product_id;?>" class="btn-update-admin">Update Product</a>
                                            <a href="<?php echo HOMEURL;?>admin/delete-product.php?product_id=<?php echo $product_id;?>&image_name=<?php echo $image_name; ?>" class="btn-delete-admin">Delete Product</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        } 
                        
                        else{
                            ?>

                            <tr>
                                <td colspan="9"><div class="error">Products has not been added yet</div></td>
                            </tr>

                            <?php
                        }
                        
                    ?>
                   
                   
                </table>
            </div>  
</div>
<?php include('partials/footer.php')?>
