<?php

// Include constants.php file here
include('../config/constants.php'); 

// 1. Get the id of the admin to be deleted
$id = $_GET['id'];

// 2. Create SQL query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the query 
$res = mysqli_query($conn, $sql);

// Check whether the query was successful
if ($res == true) {
    // Query executed successfully, and admin deleted 
    //echo "Admin deleted";

    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted seccesfully.</div>";

    //Redirect to manage admin page 
    header("location:".SITEURL.'admin/manage-admin.php');
} else {
    //echo "Failed to delete Admin: " . mysqli_error($conn);

    $_SESSION['delete']="<div class='error'>Failed to delete Admin.Try Again latter.</div>";
    header("location:".SITEURL.'admin/manage-admin.php');

}

// 3. Redirect to the manage Admin page with a message (success/error)

?> 
