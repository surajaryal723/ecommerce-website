<?php

include('../config/constants.php');

//destroy session
session_destroy();

header("location:".HOMEURL.'admin/login-admin.php');

?>