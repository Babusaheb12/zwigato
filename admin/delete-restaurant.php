<?php
// Include the constants file
include('../config/constants.php');


if(isset($_GET['id']) && isset($_GET['image']) && isset($_GET['image1']) && isset($_GET['image2']) && isset($_GET['image3']) && isset($_GET['image4']) && isset($_GET['image5'])) {
    $id = $_GET['id'];
    $image = $_GET['image'];
    $image1 = $_GET['image1'];
    $image2 = $_GET['image2'];
    $image3 = $_GET['image3'];
    $image4 = $_GET['image4'];
    $image5 = $_GET['image5'];

    // Function to remove an image and check for success
    function removeImage($imagePath)
    {
        if (!empty($imagePath)) {
            $path = "../restaurant-img/" . $imagePath;
            if (file_exists($path)) {
                if (unlink($path)) {
                    return true; // Successfully removed image
                } else {
                    // Print an error message or log it
                    error_log("Failed to unlink image file: $path");
                }
            } else {
                // Print an error message or log it
                error_log("Image file not found: $path");
            }
        } else {
            // Print an error message or log it
            error_log("Empty image path provided");
        }
        return false; // Failed to remove image
    }
    

    // Remove all images
    $imagesRemoved = [
        removeImage($image),
        removeImage($image1),
        removeImage($image2),
        removeImage($image3),
        removeImage($image4),
        removeImage($image5)
    ];

    // Check if any image removal failed
    if (in_array(false, $imagesRemoved)) {
        $_SESSION['upload'] = "<div class='error'>Failed to remove one or more image files.</div>";
        header('location: ' . SITEURL . 'admin/manage-restaurant-food.php');
        die();
    }

    $sql = "DELETE FROM tbl_add_restaurant WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res === TRUE) {
        // Restaurant deleted successfully
        $_SESSION['delete'] = "<div class='success'>Restaurant deleted successfully.</div>";
        header('location: ' . SITEURL . 'admin/manage-restaurant-food.php');
    } else {
        // Failed to delete restaurant
        $_SESSION['unauthorized'] = "<div class='error'>Failed to delete restaurant: " . mysqli_error($conn) . "</div>";
        header('location: ' . SITEURL . 'admin/manage-restaurant-food.php');
    }
} else {
    // Unauthorized access
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
    header('location: ' . SITEURL . 'admin/manage-restaurant-food.php');
}
