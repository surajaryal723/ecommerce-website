<?php

if(!isset($_SESSION['user']))
{
    $_SESSION['login-message']="<div class='error'> Please log in to access the admin panel</div>";
    header("location:".HOMEURL.'admin/login-admin.php');
}
?>