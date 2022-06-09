<?php include('partials/navbar.php');?>

<h1>Update Product</h1>

<br><br>


<?php 
        
            
            if(isset($_GET['product_id']))
            {
                
                $product_id = $_GET['product_id'];
              
                $sql = "SELECT * FROM tbl_product WHERE product_id=$product_id";

               
                $res = mysqli_query($conn, $sql);

               
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    
                    $_SESSION['no-product-found'] = "<div class='error'>No product found</div>";
                    header('location:'.HOMEURL.'admin/manage-product.php');
                }

            }
            else
            {
               
                header('location:'.HOMEURL.'admin/manage-product.php');
            }
        
        ?>

<div class="update-product">
    <form class="admin-input-form" action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input class="admin-input" type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="description" id="" cols="30" rows="5"><?php echo $description;?></textarea>
                </td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="number" name="price" id="" min="1" value="<?php echo $price;?>"></td>
            </tr>


            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                if($current_image != "")
                {
                    
                    ?>
                    <img src="<?php echo HOMEURL; ?>images/product/<?php echo $current_image; ?>" width="100px">
                    <?php
                }
                else
                {
                    
                    echo "<div class='pwd-error'>Image Not Added.</div>";
                }
            ?>
                </td>
            </tr>

            <tr>
                <td>New Image: </td>
                <td>
                    <input style="padding-left:100px;" type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="submit" name="submit" value="Update product" class="btn-add-admin">
                </td>
            </tr>

        </table>

    </form>
</div>

<?php 
        
            if(isset($_POST['submit']))
            {
               
                $product_id = $_POST['product_id'];
                $title = $_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

               
                if(isset($_FILES['image']['name']))
                {
                
                    $image_name = $_FILES['image']['name'];

                   
                    if($image_name != "")
                    {
                      
                        $ext = end(explode('.', $image_name));

                       
                        $image_name = "Product_".rand(000, 999).'.'.$ext; 
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/product/".$image_name;

                        
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                         
                            header('location:'.HOMEURL.'admin/manage-product.php');
                          
                            die();
                        }

                      
                        if($current_image!="")
                        {
                            $remove_path = "../images/product/".$current_image;

                            $remove = unlink($remove_path);

                    
                            if($remove==false)
                            {
                                
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.HOMEURL.'admin/manage-product.php');
                                die();
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                
                $sql2 = "UPDATE tbl_product SET 
                    title = '$title',
                    description='$description',
                    price='$price',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE product_id=$product_id
                ";

              
                $res2 = mysqli_query($conn, $sql2);

              
                if($res2==true)
                {
                    
                    $_SESSION['update'] = "<div class='success'>Product Updated Successfully</div>";
                    header('location:'.HOMEURL.'admin/manage-product.php');
                }
                else
                {
                    
                    $_SESSION['update'] = "<div class='error'>Failed to Update product</div>";
                    header('location:'.HOMEURL.'admin/manage-product.php');
                }

            }
        
        ?>
<?php include('partials/footer.php');?>