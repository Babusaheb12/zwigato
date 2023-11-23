<?php include('partilas/menu.php')  ?>
<div class="main-content">
    <div class="wrapper">
        <h1>update restaurant category</h1>
        <br><br>

        <?php
        //check whether the id is set or not.
        if (isset($_GET['id'])) {
            //get the id and all other details
            // echo "creating the data";
            $id = $_GET['id'];

            //create sql Query to get all other details
            $sql = "SELECT * FROM tbl_category_restaurant WHERE id=$id";

            //Execute the query 
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether id is valid or not
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //Get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //Redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>category not found</div>";
                header('location: ' . SITEURL . 'admin/manage-restaurant.php');
            }
        } else {
            //redirect to manage category
            header('location: ' . SITEURL . 'admin/manage-restaurant.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>


                <tr>
                    <td>description :</td>
                    <td>
                        <input type="text" name="description" value="<?php echo $description; ?>">
                    </td>
                </tr>

                <tr>
                    <td>current image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px" alt="image">

                        <?php

                        } else {
                            //Display message
                            echo "<div class='error'> image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>new image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>featured</td>
                    <td>
                        <input <?php if ($featured == "yes") echo "checked"; ?> type="radio" name="featured" value="yes">yes

                        <input <?php if ($featured == "no") echo "checked"; ?> type="radio" name="featured" value="no">no
                    </td>
                </tr>
                <tr>
                    <td>active</td>
                    <td>
                        <input <?php if ($active == "yes") echo "checked"; ?> type="radio" name="active" value="yes">yes

                        <input <?php if ($active == "no") echo "checked"; ?> type="radio" name="active" value="no">no

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update Category" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // echo "clicked";
            //1.get the all value from our form

            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            //2. updating the image selected
            //check whether image is selected or not
            // ...

            // Check whether image is selected or not
            if (isset($_FILES['image']['name'])) {
                // Get the image details
                $image_name = $_FILES['image']['name'];

                // Check whether an image is available or not
                if ($image_name != "") {
                    // Image available
                    // Upload the new image
                    // $ext = end(explode(',', $image_name));
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);


                    // Rename the image
                    $image_name = "Food_category_" . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../restaurant-img\category-restaurant/" . $image_name; // Use forward slash here
                    // Finally, upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    // If the image is not uploaded, then we will stop the process and redirect with an error message
                    if ($upload == false) {
                        // Set image upload error
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";

                        // Redirect to add category page
                        header('location: ' . SITEURL . 'admin/manage-restaurant.php');

                        // Stop the process
                        die();
                    }
                    // Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../restaurant-img\category-restaurant/" . $current_image;
                        $remove = unlink($remove_path);

                        // Check if the image is removed or not
                        // If failed to remove it, display a message and stop the process
                        if ($remove == false) {
                            // Failed to remove image
                            $_SESSION['failed_remove'] = "<div class='error'>Failed to remove your current image</div>";
                            header('location: ' . SITEURL . 'admin/manage-restaurant.php');

                            // Stop the process
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // ...


            //3. update the database
            $sql2 = "UPDATE tbl_category_restaurant SET
            title='$title',
            description='$description',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id='$id'";


            //Execute the query.
            $res2 = mysqli_query($conn, $sql2);

            //4. redirect to manage category with image.
            //check the executed or not.
            if ($res2 == true) {
                //category updated 
                $_SESSION['update'] = "<div class='successA'>category update successfully</div>";
                header('location: ' . SITEURL . 'admin/manage-restaurant.php');
            } else {
                //failed the update category.
                $_SESSION['update'] = "<div class='error'>failed to category update </div>";
                header('location: ' . SITEURL . 'admin/manage-restaurant.php');
            }
        }

        ?>
    </div>
</div>


<?php include('partilas/footer.php')  ?>