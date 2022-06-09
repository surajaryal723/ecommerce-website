<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <?php 
        
            //Check whether the category_id is set or not
            if(isset($_GET['category_id']))
            {
                // getting the category id
                $category_id = $_GET['category_id'];
                // getting data from table for selected category
                $sql = "SELECT * FROM tbl_category WHERE category_id=$category_id";

                
                $res = mysqli_query($conn, $sql);

               
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }

            }
            else
            {
              
                header('location:'.HOMEURL.'admin/manage-category.php');
            }
        
        ?>

        <form class="admin-input-form" action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input class="admin-input" type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                
                                ?>
                                <img src="<?php echo HOMEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
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
                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-add-admin">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                
              
                $category_id = $_POST['category_id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating the image by checking whether the new image has been selected or not
                if(isset($_FILES['image']['name']))
                {
                   
                    $image_name = $_FILES['image']['name'];

                   
                    if($image_name != "")
                    {
                        
                        $ext = end(explode('.', $image_name));

                        
                        $image_name = "Product_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        
                        $upload = move_uploaded_file($source_path, $destination_path);

                        
                        if($upload==false)
                        {
                            
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                           
                            header('location:'.HOMEURL.'admin/manage-category.php');
                           
                            die();
                        }

                        // remove the previous image
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.HOMEURL.'admin/manage-category.php');
                                die();//Stop the Process
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

                //Update the Database
                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE category_id=$category_id
                ";

              
                $res2 = mysqli_query($conn, $sql2);

                
                if($res2==true)
                {
                   
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }
                else
                {
                    
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }

            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>