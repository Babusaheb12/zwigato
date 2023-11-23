<?php
// Include the constants file
include('../config/constants.php');

// Check if both 'id' and 'image_name' are set in the URL
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // Get the values
    $id = $_GET['id'];
    $image = $_GET['image_name'];

    // Remove the physical image file if it exists
    if (!empty($image)) {
        $path = "../images/category/" . $image;

        // Attempt to remove the image file
        if (!unlink($path)) {
            // If failed to remove the image, set an error message and stop the process
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
            header("location:" . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    // Delete the data from the database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    // Execute the query and handle errors
    $res = mysqli_query($conn, $sql);
    
    if ($res) {
        // Success message and redirection
        $_SESSION['delete'] = "<div class='successA'>Category deleted successfully.</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else {
        // Error message and redirection with SQL error details
        $_SESSION['delete'] = "<div class='error'>Failed to delete category: " . mysqli_error($conn) . "</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    }
} else {
    // Redirect to the manage category page if 'id' or 'image_name' is not set
    header("location:" . SITEURL . 'admin/manage-category.php');
}
?>
