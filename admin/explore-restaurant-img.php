<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add restaurant image</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Restaurant:</td>
                    <td>
                        <select name="restaurant_id">
                            <?php
                            // Fetch active restaurants from the database
                            $sql = "SELECT * FROM tbl_add_restaurant WHERE active = 'yes'";
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no" checked>No
                    </td>
                </tr>
                <tr>
                    <td>Images:</td>
                    <td>
                        <input type="file" name="images[]" multiple>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" checked>Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Restaurant" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <hr>

    <?php
    if (isset($_POST['submit'])) {
        $restaurant_id = isset($_POST['restaurant_id']) ? $_POST['restaurant_id'] : '';
        $featured = isset($_POST['featured']) ? $_POST['featured'] : 'no';
        $active = isset($_POST['active']) ? $_POST['active'] : 'no';

        if (isset($_FILES['images']['name'])) {
            $total_images = count($_FILES['images']['name']);

            for ($i = 0; $i < $total_images; $i++) {
                $image_name = $_FILES['images']['name'][$i];

                if ($image_name != "") {
                    $image_name_parts = pathinfo($image_name);
                    $ext = $image_name_parts['extension'];
                    $image_name = "Restaurant_Image_" . rand(0000, 9999) . "." . $ext;
                    $src = $_FILES['images']['tmp_name'][$i];
                    $dst = "../restaurant-img/restaurant_img/" . $image_name;

                    if (move_uploaded_file($src, $dst)) {
                        // Image uploaded successfully
                        $sql = "INSERT INTO `tbl_restaurant_img` (`restaurant_id`, `image_name`, `featured`, `active`) 
                                VALUES ('$restaurant_id', '$image_name', '$featured', '$active')";
                        $res2 = mysqli_query($conn, $sql);
                    } else {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload one or more images.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        exit;
                    }
                }
            }
        }
    }
    ?>
</div>


<!-- 	id	restaurant_id	image	featured	active	
 -->
<br> <br>
<div class="wrapper">
    <h1>show image</h1>

    <table class="tbl-full">
        <tr>
            <th>S. No.</th>
            <th>title</th>
            <th>image</th>
            <th>featured</th>
            <th>active</th>
        </tr>
        <?php
        $sql = "SELECT * FROM tbl_restaurant_img";
        //execute the query
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $count = mysqli_num_rows($res);
            //function to get all the data in database.
            if ($count > 0) {
                $n = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $restaurant_id = $row['restaurant_id'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

        ?>

                    <tr>
                        <td><?php echo $n++ ?></td>
                        <td><?php echo $restaurant_id; ?></td>
                        <td>
                            <?php
                            if (!empty($image_name)) {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/restaurant_img/<?php echo $image_name; ?>" width="100px" alt="image">
                            <?php
                            } else {
                                echo "<div class='error'>Image not added</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                    </tr>

        <?php
                }
            }
        }
        ?>



    </table>

</div>





<?php include('partilas/footer.php'); ?>