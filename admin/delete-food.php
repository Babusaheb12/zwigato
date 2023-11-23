<?php
// Include the constants file
include('../config/constants.php');

// Check whether the id and image_name are set or not.
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Get id and image name to remove.
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image if available
    // Check whether the image is available or not and delete only if available
    if ($image_name != "") {
        // Check if the image file exists in the given path
        $path = "../images/food/" . $image_name; // Use forward slash / here

        // Remove the image from the folder
        $remove = unlink($path);

        // Check whether the image is removed or not
        if ($remove == false) {
            // Failed to remove the image
            $_SESSION['upload'] = "<div class='error'>Failed to remove the image file.</div>";

            // Redirect to manage food
            header('location: ' . SITEURL . 'admin/manage-food.php');
            
            // Stop the process of deleting the food
            die();
        }
    }

    // Delete food from the database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not and set the session message accordingly
    // Redirect to manage food with session message
    if ($res == TRUE) {
        // Food deleted successfully
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";

        // Redirect to manage food
        header('location: ' . SITEURL . 'admin/manage-food.php');
    } else {
        // Failed to delete food
        $_SESSION['unauthorized'] = "<div class='error'>Failed to delete food.</div>";

        // Redirect to manage food
        header('location: ' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // Redirect to manage food
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
    header('location: ' . SITEURL . 'admin/manage-food.php');
}
?>