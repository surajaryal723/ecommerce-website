<?php include('partials/navbar.php');?>
        <div class="main">
            <h2>Dashboard</h2>
            <?php
             if(isset($_SESSION['login-success'])){ //checking session set or not
                echo $_SESSION['login-success']; //displaying session message
                unset($_SESSION['login-success']); //closing the session
            }
            ?>
            <div class="dashboard">
                <div class="box-4">
                    <?php
                        $sql="SELECT * FROM tbl_category";
                        $res=mysqli_query($conn,$sql);
                        if($res==true){
                            $count=mysqli_num_rows($res);
                        }
                        ?>
                        <h1><?php echo $count;?></h1>
                        <?php
                    ?>
                    
                   <br>
                   <h4>Categories</h4>

                </div>
                <div class="box-4">
                <?php
                        $sql2="SELECT * FROM tbl_product";
                        $res2=mysqli_query($conn,$sql2);
                        if($res2==true){
                            $count=mysqli_num_rows($res2);
                        }
                        ?>
                        <h1><?php echo $count;?></h1>
                        <?php
                ?>
                    <br>
                    <h4>Products</h4>
                </div>
                <div class="box-4">
                <?php
                        $sql3="SELECT * FROM tbl_order";
                        $res3=mysqli_query($conn,$sql3);
                        if($res3==true){
                            $count=mysqli_num_rows($res3);
                        }
                        ?>
                        <h1><?php echo $count;?></h1>
                        <?php
                    ?>
                    <br>
                    <h4>Total Orders</h4>
                </div>
                <div class="box-4">
                <?php
                    $sql4="SELECT SUM(total) AS Total FROM tbl_order";
                        $res4=mysqli_query($conn,$sql4);
                        if($res4==true){
                            $row=mysqli_fetch_assoc($res4);
                            $revenue=$row['Total'];
                        }
                        ?>
                        <h1>₹&nbsp;<?php echo $revenue;?></h1>
                        <?php
                    ?>
                    <br>
                    <h4>Revenue Generated</h4>
                </div>
            </div>

        </div>
        <?php include('partials/footer.php')?>
       

    
</body>
</html>