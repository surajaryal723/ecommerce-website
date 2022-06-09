<?php
session_start();
define('HOMEURL','http://localhost/dbms/');
define('LOCALHOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_NAME','ecommerce');
 // database connection
 $conn=mysqli_connect(LOCALHOST,DB_USER,DB_PASSWORD) or die(mysqli_error());
 // selecting database
 $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
?>