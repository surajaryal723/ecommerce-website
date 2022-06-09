<?php 
  
    include('../config/constants.php');

    
    if(isset($_GET['product_id']) AND isset($_GET['image_name']))
    {
        
        $product_id = $_GET['product_id'];
        $image_name = $_GET['image_name'];

      
        if($image_name != "")
        {
            
            $path = "../images/product/".$image_name;
           
            $remove = unlink($path);

            if($remove==false)
            {
             
                $_SESSION['remove'] = "<div class='error'>Failed to Remove product Image.</div>";
               
                header('location:'.HOMEURL.'admin/manage-product.php');
               
                die();
            }
        }

        
        $sql = "DELETE FROM tbl_product WHERE product_id=$product_id";

       
        $res = mysqli_query($conn, $sql);

       
        if($res==true)
        {
          
            $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully.</div>";
            
            header('location:'.HOMEURL.'admin/manage-product.php');
        }
        else
        {
            
            $_SESSION['delete'] = "<div class='error'>Failed to Delete product.</div>";
           
            header('location:'.HOMEURL.'admin/manage-product.php');
        }

 

    }
    else
    {
       
        header('location:'.HOMEURL.'admin/manage-product.php');
    }
?>