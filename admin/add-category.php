<?php include('partilas/menu.php')  ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) 
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) 
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br> <br>


        <!-- add category page start -->

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title: </td>

                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>

                <tr>
                    <td>Select image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>featured</td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">no

                    </td>
                </tr>

                <tr>
                    <td>active</td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">no

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        
                    </td>
                </tr>
            </table>
        </form>

        <!-- end acategory page -->

        <?php
       if (isset($_POST['submit'])) {
        // Get the values from the category form.
        $title = $_POST['title'];
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "no";
        $active = isset($_POST['active']) ? $_POST['active'] : "no";

        // Check if an image is selected for upload.
        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];
            $text = end(explode(',', $image_name));
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;
        
            if (move_uploaded_file($source_path, $destination_path)) {
                // Image uploaded successfully.
            } else {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header('location: ' . SITEURL . 'admin/add-category.php');
                die();
            }
        } else {
            // No image selected, set the image name to blank.
            $image_name = "";
        }
        

        // Create a secure SQL query using prepared statements.
        $sql = "INSERT INTO tbl_category (title, image_name, featured, active) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $title, $image_name, $featured, $active);
        
        // Execute the query.
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['add'] = "<div class='successA'>Category added successfully.</div>";
            header("location:" . SITEURL . 'admin/add-category.php');
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
            header("location:" . SITEURL . 'admin/add-category.php');
        }

        mysqli_stmt_close($stmt);
    }
        ?>

    </div>
</div>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br>

<?php include('partilas/footer.php')  ?>


