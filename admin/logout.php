<?php
//include constant .php
include('../config\constants.php');

//1.Destory the session
session_destroy();  // unset


//2. redirect to login page
header("location:" . SITEURL . 'admin/login.php');

?>