<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
    <title>Electronics Store</title>
    <body>
    <div class="navbar">
        <div>
            <img src="" alt="logo" class="logo">
        </div>
        <div class="search">
            <form action="<?php echo HOMEURL;?>search.php" method="POST">
                <input class="search-bar" type="search" name="search" placeholder="Search for your products">
                <input class="search-btn" type="submit" value="Search">
            </form>
        </div>
        <ul class="menu-items">
            <li class="menu-item"><a class="nav-item" href="<?php echo HOMEURL;?>">Home</a></li>
            <li class="menu-item"><a class="nav-item" href="<?php echo HOMEURL;?>categories.php">Categories</a></li>
            <li class="menu-item"><a class="nav-item" href="<?php echo HOMEURL;?>products.php">Products</a></li>
            <!-- <li class="menu-item"><a class="nav-item" href="#">Contact</a></li> -->
            <li class="menu-item"><a class="nav-item" href="<?php echo HOMEURL;?>logout-user.php">Log Out</a></li>
            <li class="menu-item"><a class="nav-item" href="<?php echo HOMEURL;?>admin">Log In As Admin</a></li>
            <img class="admin-img" src="images/admin.png" alt="">
        </ul>
    </div>
</head>