<?php include('partials/navbar.php');?>
<h1>Add Product</h1>

<br><br>

<?php

            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
?>
<br><br>

<form class="admin-input-form" action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input class="admin-input" type="text" name="title" placeholder="Product Title">
            </td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea name="description" id="" cols="30" rows="5"></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="number" name="price" id="" min="1"></td>
        </tr>
        <tr>
            <td>Category:</td>
            <td><select name="category" >

                    <?php
                    // creating a dropdown for all the active categories in the database

                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $category_id=$rows['category_id'];
                            $title=$rows['title'];
                            ?>
                    <option value="<?php echo $category_id;?>"><?php echo $title;?></option>
                    <?php
                        }
                        
                    }
                    else{
                        ?>
                    <option value="0">No categories added </option>
                    <?php
                    }
                    ?>



                </select></td>
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
                <input type="radio" name="featured" value="Yes" required> Yes
                <input type="radio" name="featured" value="No" required> No
            </td>
        </tr>

        <tr>
            <td>Active: </td>
            <td>
                <input type="radio" name="active" value="Yes" required> Yes
                <input type="radio" name="active" value="No" required> No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Product" class="btn-add-admin">
            </td>
        </tr>

    </table>


</form>
<?php
if(isset($_POST['submit'])){
    
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];



    if(isset($_FILES['image']['name']))
                {
                    
                    $image_name = $_FILES['image']['name'];

                    
                    if($image_name!="")
                    {
                       
                        $ext = end(explode('.', $image_name));

                        
                        $image_name = "Product-".rand(0000,9999).".".$ext; 

                       
                        $src = $_FILES['image']['tmp_name'];

                        
                        $dst = "../images/product/".$image_name;

                        
                        $upload = move_uploaded_file($src, $dst);

                        
                        if($upload==false)
                        {
                           
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.HOMEURL.'admin/add-product.php');
                           
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = "";
                }

               
                $sql2 = "INSERT INTO tbl_product SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

               
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                if($res==true)
                {
                   
                    $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
                    
                    header('location:'.HOMEURL.'admin/manage-product.php');
                }
                else
                {
                    
                    $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
                    
                    header('location:'.HOMEURL.'admin/manage-product.php');
                }

}
?>

<?php include('partials/footer.php');?>