<?php include('partilas/menu.php') ?>
<?php
// Check whether 'id' is set or not.
if (isset($_GET['id'])) {
    // Get all details
    $id = $_GET['id'];

    // SQL query executed
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    // Execute the query
    $res2 = mysqli_query($conn, $sql2);

    // Get the values based on query execution
    $row2 = mysqli_fetch_assoc($res2);

    // Get individual values from the selected database row
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    // Redirect to manage food.
    header('location: ' . SITEURL . 'admin/manage-food.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if (!empty($current_image)) {
                            echo '<img src="' . SITEURL . 'images/food/' . $current_image . '" width="100px" alt="Current Image">';
                        } else {
                            echo 'No image available';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            // Query to get active categories
                            $sql = 'SELECT * FROM tbl_category WHERE active="yes"';

                            // Execute the query
                            $res = mysqli_query($conn, $sql);

                            // Check if categories are available or not.
                            if ($res) {
                                // Categories are available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    // Use ternary operator to set 'selected' attribute if it matches current category
                                    $selected = ($current_category == $category_id) ? 'selected' : '';

                                    echo "<option value='$category_id' $selected>$category_title</option>";
                                }
                            } else {
                                // Categories not available
                                echo "<option value='0'>Category not available.</option>";
                            }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if ($featured == "yes") echo "checked"; ?>>Yes
                        <input type="radio" name="featured" value="no" <?php if ($featured == "no") echo "checked"; ?>>No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" <?php if ($active == "yes") echo "checked"; ?>>Yes
                        <input type="radio" name="active" value="no" <?php if ($active == "no") echo "checked"; ?>>No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check if a new image is uploaded
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                // Check if the file is not empty
                if (!empty($image_name)) {
                    // Rename the image
                    $image_name_parts = explode('.', $image_name);
                    $ext = end($image_name_parts);
                    $image_name = "food-name-" . rand(0000, 9999) . '.' . $ext;

                    // Get the source path and destination path
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/" . $image_name;

                    // Upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    // Check if the image upload was successful
                    if (!$upload) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";

                        // Redirect to the manage-food page
                        header('location: ' . SITEURL . 'admin/manage-food.php');
                        die();
                    }

                    // Remove the current image if it exists
                    // Remove the current image if it exists
                     // Remove the current image if it exists
                   if (!empty($current_image)) {
                       $remove_path = "../images/food/" . $current_image;
                       
                       // Check if the file exists before attempting to delete it
                       if (file_exists($remove_path)) {
                           $remove = unlink($remove_path);
                   
                           // Check if the current image was removed successfully
                           if (!$remove) {
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                 
                             // Redirect to the manage-food page
                             header('location: ' . SITEURL . 'admin/manage-food.php');
                             die();
                         }
                     }
                 }
                }
                else{
                    //dafault image when is not selecated.
                    
                    $image_name=$current_image;
                }


            } else {
                // If no new image is uploaded, use the current image name
                $image_name = $current_image;
            }

            // Update the food in the database
            $sql3 = "UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            WHERE id=$id";

            // Execute the SQL query
            $res3 = mysqli_query($conn, $sql3);

            // Redirect to the manage-food page
            // header('location: ' . SITEURL . 'admin/manage-food.php');

            if ($res2 == true) {
                //category updated 
                $_SESSION['update'] = "<div classd='successA'>category update successfully</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //failed the update category.
                $_SESSION['update'] = "<div classd='error'>failed to category update </div>";
                header('location: ' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partilas/footer.php'); ?>




