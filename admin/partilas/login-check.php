<?php

//Authorization - Access control 
//check whether the user is login or not
if(!isset($_SESSION['user']))  // if user session is not login 
{
$_SESSION['no-login-message']="<div class='kljhgfd'>please login acess login pannel.</div>";
//Redirect to login page
header("location:" . SITEURL . 'admin/login.php');
}
?>