<?php include('partials/navbar.php')?>
<div class="main">
    <h2>Manage Admin</h2>


    <?php
             if(isset($_SESSION['add'])){ //checking session set or not
                echo $_SESSION['add']; //displaying session message
                unset($_SESSION['add']); //closing the session
            }
            ?>
    <?php
             if(isset($_SESSION['delete'])){ //checking session set or not
                echo $_SESSION['delete']; //displaying session message
                unset($_SESSION['delete']); //closing the session
            }
            ?>
    <?php
             if(isset($_SESSION['update'])){ //checking session set or not
                echo $_SESSION['update']; //displaying session message
                unset($_SESSION['update']); //closing the session
            }
            ?>
    <?php
             if(isset($_SESSION['not-found'])){ //checking session set or not
                echo $_SESSION['not-found']; //displaying session message
                unset($_SESSION['not-found']); //closing the session
            }
            ?>


    <?php
             if(isset($_SESSION['pwd-match'])){ //checking session set or not
                echo $_SESSION['pwd-match']; //displaying session message
                unset($_SESSION['pwd-match']); //closing the session
            }
            ?>

    <br><br><br><br><br>


    <a href="<?php echo HOMEURL;?>admin/add-admin.php" class="btn-add-admin">Add Admin</a>
    <div class="admin-table">


        <table>
            <tr>
                <th>Admin ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql="SELECT * from tbl_admin"; //selecting all the rows from tbl_admin

            $res=mysqli_query($conn,$sql); //store the result of query

            if($res==TRUE) //if rows are there
            {
                $count=mysqli_num_rows($res);  //counting the number of rows

                if($count>0){
                    while($rows=mysqli_fetch_assoc($res)) //fetching the data from rows and storing to $rows
                    {
                        $admin_id=$rows['admin_id'];
                        $fullname=$rows['full_name'];
                        $username=$rows['username'];
                        ?>
                <tr>
                    <td><?php echo $admin_id?></td>
                    <td><?php echo $fullname?></td>
                    <td><?php echo $username?></td>
                    <td><a href="<?php echo HOMEURL;?>admin/update-admin.php?admin_id=<?php echo $admin_id; ?>"
                            class="btn-update-admin">Update Admin</a>
                        <a href="<?php echo HOMEURL;?>admin/delete-admin.php?admin_id=<?php echo $admin_id; ?>"
                            class="btn-delete-admin">Delete Admin</a>
                        <a href="<?php echo HOMEURL;?>admin/change-password.php?admin_id=<?php echo $admin_id;?>"
                            class="btn-change-password">Change Password</a>
                    </td>
                </tr>
            <?php

                    }
                }
            }


            ?>




        </table>
    </div>
</div>
<?php include('partials/footer.php')?>