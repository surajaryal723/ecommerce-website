<?php 
    
    include('../config/constants.php');

    
    //Check whether the category_id and image_name value is set or not
    if(isset($_GET['category_id']) AND isset($_GET['image_name']))
    {
        //getting the values
        $category_id = $_GET['category_id'];
        $image_name = $_GET['image_name'];

    //    removing the image from the images/category-folder
        if($image_name != "")
        {
            
            $path = "../images/category/".$image_name;
            //REmove the Image
            $remove = unlink($path);

            //IF failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the SEssion Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //Redirect to Manage Category page
                header('location:'.HOMEURL.'admin/manage-category.php');
                //Stop the Process
                die();
            }
        }

        // query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE category_id=$category_id";

        
        $res = mysqli_query($conn, $sql);

     
        if($res==true)
        {
            
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
         
            header('location:'.HOMEURL.'admin/manage-category.php');
        }
        else
        {
            
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            
            header('location:'.HOMEURL.'admin/manage-category.php');
        }

 

    }
    else
    {
        //redirect to Manage Category Page
        header('location:'.HOMEURL.'admin/manage-category.php');
    }
?>