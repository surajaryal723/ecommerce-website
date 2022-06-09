<?php

if(!isset($_SESSION['email']))
{
    $_SESSION['login-message']="<div class='error'> Please log in to proceed</div>";
    header("location:".HOMEURL.'login-user.php');
}

?>