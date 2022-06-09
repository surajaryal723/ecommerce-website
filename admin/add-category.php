<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
            if(isset($_SESSION['title-taken']))
            {
                echo $_SESSION['title-taken'];
                unset($_SESSION['title-taken']);
            }
        
        ?>

        <br><br>

        <!-- form to add category -->
        <form class="admin-input-form" action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input class="admin-input" type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input style="padding-left:100px;" type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-add-admin">
                    </td>
                </tr>

            </table>

        </form>
        

        <?php 
        
            
            if(isset($_POST['submit']))
            {
                

                //1. Get the Value from CAtegory Form
                $title = $_POST['title'];

                // checking the radio buttons are clicked or not
                if(isset($_POST['featured']))
                {
                    //Get the VAlue from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //SEt the Default VAlue
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                // check wheteher the add image button is clicked or not
                //print_r($_FILES['image']);

                //die();//Break the Code Here

                if(isset($_FILES['image']['name']))
                {
                    // get the image name
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {

                        // renaming the image by extracting the extension from original image name
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Product_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // uploading the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // checking whether the image is uploaded or not
                        if($upload==false)
                        {
                            
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                           
                            header('location:'.HOMEURL.'admin/add-category.php');
                            // if not uploaded we will stop the Process
                            die();
                        }

                    }
                }
                else
                {
                    
                    $image_name="";
                }

                // checking if category name already exist in the database or not

                $sql2="SELECT * FROM tbl_category WHERE title='$title'";
                $res2=mysqli_query($conn,$sql2);
        
                $count=mysqli_num_rows($res2);
                if($count==0){
                    
                

                    // sql to insert data of actegory to database
                    $sql = "INSERT INTO tbl_category SET 
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    ";

                    $res = mysqli_query($conn, $sql);

                   
                    if($res==true)
                    {
                        
                        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                        
                        header('location:'.HOMEURL.'admin/manage-category.php');
                    }
                    else
                    {
                      
                        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                      
                        header('location:'.HOMEURL.'admin/add-category.php');
                    }
                }
                
                else
                {
                    $_SESSION['title-taken']="<div class='pwd-error'>Title already taken</div>";
                    header("location:".HOMEURL.'admin/add-category.php');

                }
                            
            }
            
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>