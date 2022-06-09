<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
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

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
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
        <br><br>

                
                <a href="<?php echo HOMEURL; ?>admin/add-category.php" class="btn-add-admin">Add Category</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>Category ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 

                        // getting data from category table
                        $sql = "SELECT * FROM tbl_category";

                        
                        $res = mysqli_query($conn, $sql);

                        //Count Rows
                        $count = mysqli_num_rows($res);

                    
                        
                        if($count>0)
                        {
                        //    display the data in table
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_id = $row['category_id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $category_id ?>. </td>
                                        <td><?php echo $title; ?></td>

                                        <td>

                                            <?php  
                                                // checking whether the image is available or not
                                                if($image_name!="")
                                                {
                                                    //Display the Image
                                                    ?>
                                                    
                                                    <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                                    
                                                    <?php
                                                }
                                                else
                                                {
                                                    
                                                    echo "<div class='pwd-error'>Image not Added.</div>";
                                                }
                                            ?>

                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo HOMEURL; ?>admin/update-category.php?category_id=<?php echo $category_id; ?>" class="btn-update-admin">Update Category</a>
                                            <a href="<?php echo HOMEURL; ?>admin/delete-category.php?category_id=<?php echo $category_id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete-admin">Delete Category</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                       
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr>

                            <?php
                        }
                    
                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>