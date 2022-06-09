<?php include('partials/navbar.php');?>
<h1>Product Management History</h1>
<?php
$sql="SELECT * FROM logs";
$res=mysqli_query($conn,$sql);
if($res==true){
    $count=mysqli_num_rows($res);
    if($count>0){
        while($rows=mysqli_fetch_assoc($res)){
            $id=$rows['product_id'];
            $action=$rows['action'];
            $date=$rows['created_on'];
            ?>
            <table>
                <tr>A product with id <strong><?php echo $id;?></strong> was <strong><?php echo $action;?></strong> on <strong><?php echo $date;?></strong></tr>
            </table>
<?php
        }
    }
}

?>

<?php include('partials/footer.php');?>