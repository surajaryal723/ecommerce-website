<?php include('partials/navbar.php')?>
<div class="admin-table">


    <table>
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Contact Number</th>
            <th>Email</th>
        </tr>
        <?php
    $sql="SELECT * from tbl_user"; //selecting all the rows from tbl_admin

    $res=mysqli_query($conn,$sql); //store the result of query

    if($res==TRUE) //if rows are there
    {
        $count=mysqli_num_rows($res);  //counting the number of rows

        if($count>0){
            while($rows=mysqli_fetch_assoc($res)) //fetching the data from rows and storing to $rows
            {
                $user_id=$rows['user_id'];
                $fullname=$rows['Fullname'];
                $contact=$rows['Contact'];
                $email=$rows['Email'];
                ?>
        <tr>
            <td><?php echo $user_id;?></td>
            <td><?php echo $fullname;?></td>
            <td><?php echo $contact;?></td>
            <td><?php echo $email;?></td>
            
        </tr>
        <?php

            }
        }
    }


    ?>




    </table>
</div>
<?php include('partials/footer.php')?>