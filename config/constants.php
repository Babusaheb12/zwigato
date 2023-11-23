<?php
//start seassion
session_start();

//constant to store non-reparting values
define('SITEURL','http://localhost/Zwigato/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

//3.Execute query and save data in database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection

// $conn=mysqli_connect('LOCALHOST','DB_USERNAME','DB_PASSWORD') or die(mysqli_error()); //database connection
// $db_select=mysqli_select_db($conn,'DB_NAME') or die(mysqli_error()); //selecting database name


$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting the database name
?>


