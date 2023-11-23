<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add restaurant</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo ($_SESSION['upload']);
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['add'])) {
            echo ($_SESSION['add']);
            unset($_SESSION['add']);
        }
        ?>


        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>title:</td>
                    <td>
                        <input type="text" name="title" placeholder="name of the restaurant">
                    </td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="something about restaurantnt"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>price :</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>image explore 1:</td>
                    <td>
                        <input type="file" name="image1">
                    </td>
                </tr>
                <tr>
                    <td>image explore 2:</td>
                    <td>
                        <input type="file" name="image2">
                    </td>
                </tr>
                <tr>
                    <td>image explore 3:</td>
                    <td>
                        <input type="file" name="image3">
                    </td>
                </tr>
                <tr>
                    <td>image explore 4:</td>
                    <td>
                        <input type="file" name="image4">
                    </td>
                </tr>

                <tr>
                    <td>image explore 5:</td>
                    <td><input type="file" name="image5">
                </td>
                </tr>

                <tr>
                    <td>category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // Create a PHP code to display categories from the database.

                            // 1. Create an SQL query to get active categories from the database.
                            $sql = "SELECT * FROM tbl_category_restaurant WHERE active='yes'";

                            // Execute the query.
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                // We have categories.
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td>featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">no
                    </td>
                </tr>
                <tr>

                    <td>active:</td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">no
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add restaurant" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        //check whether a bottom is click or not
        if (isset($_POST['submit'])) {
            //asdd the restaurant in datebase.
            // echo"add restaurant";
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            

            //check whether radio button for featured and active are check or not.
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "no";   //setting default value.
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "no";   //setting default value.
            }

            //upload the image if selected.

            if (isset($_FILES['image']['name'])) {
                //get the details of the selected image.
                $image = $_FILES['image']['name'];

                //check whether the image is selected or not if the image is selected
                if ($image != "") {
                    $image_name_parts = explode('.', $image);
                    $ext = end($image_name_parts);

                    //create new name for image
                    $image = "restaurantName_" . rand(0000, 9999) . "." . $ext;
                    //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image.
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../restaurant-img/" . $image;

                    //finally uploaded the image.
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image upload or not.
                    if ($upload == false) {
                        //faild to upload image
                        //redirect to upload the image.
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image = "";  //setting default value is blanks

            }


            /* saertdyfhgujhgtfredfghjhgfrdesdfghjkjhygtrdfhjkjhgtfrdefrgthyj*/

            //upload the image if selected.

            if (isset($_FILES['image1']['name'])) {
                //get the details of the selected image.
                $image1 = $_FILES['image1']['name'];

                //check whether the image is selected or not if the image is selected
                if ($image1 != "") {
                    $image_name_parts1 = explode('.', $image1);
                    $ext = end($image_name_parts1);

                    //create new name for image
                    $image1 = "restaurantName_" . rand(0000, 9999) . "." . $ext;
                    //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image.
                    $src = $_FILES['image1']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../restaurant-img/" . $image1;

                    //finally uploaded the image.
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image upload or not.
                    if ($upload == false) {
                        //faild to upload image
                        //redirect to upload the image.
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image1 = "";  //setting default value is blanks

            }

            /* image explore 2*/

            //upload the image if selected.

            if (isset($_FILES['image2']['name'])) {
                //get the details of the selected image.
                $image2 = $_FILES['image2']['name'];

                //check whether the image is selected or not if the image is selected
                if ($image2 != "") {
                    $image_name_parts = explode('.', $image2);
                    $ext = end($image_name_parts);

                    //create new name for image
                    $image2 = "restaurantName_" . rand(0000, 9999) . "." . $ext;
                     //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image.
                    $src = $_FILES['image2']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../restaurant-img/" . $image2;

                    //finally uploaded the image.
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image upload or not.
                    if ($upload == false) {
                        //faild to upload image
                        //redirect to upload the image.
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image2 = "";  //setting default value is blanks

            }

            /* image explore 3 */

            //upload the image if selected.

            if (isset($_FILES['image3']['name'])) {
                //get the details of the selected image.
                $image3 = $_FILES['image3']['name'];

                //check whether the image is selected or not if the image is selected
                if ($image3 != "") {
                    $image_name_parts = explode('.', $image3);
                    $ext = end($image_name_parts);

                    //create new name for image
                    $image3 = "restaurantName_" . rand(0000, 9999) . "." . $ext;
                       //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image.
                    $src = $_FILES['image3']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../restaurant-img/" . $image3;

                    //finally uploaded the image.
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image upload or not.
                    if ($upload == false) {
                        //faild to upload image
                        //redirect to upload the image.
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image3 = "";  //setting default value is blanks

            }


            /*image explore 4 */

            //upload the image if selected.

            if (isset($_FILES['image4']['name'])) {
                //get the details of the selected image.
                $image4 = $_FILES['image4']['name'];

                //check whether the image is selected or not if the image is selected
                if ($image4 != "") {
                    $image_name_parts = explode('.', $image4);
                    $ext = end($image_name_parts);

                    //create new name for image
                    $image4 = "restaurantName_" . rand(0000, 9999) . "." . $ext;
                     //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image.
                    $src = $_FILES['image4']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../restaurant-img/" . $image4;

                    //finally uploaded the image.
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image upload or not.
                    if ($upload == false) {
                        //faild to upload image
                        //redirect to upload the image.
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image4 = "";  //setting default value is blanks

            }


            /* image-explore 5 */

            //upload the image if selected.

            if (isset($_FILES['image5']['name'])) {
                //get the details of the selected image.
                $image5 = $_FILES['image5']['name'];

                //check whether the image is selected or not if the image is selected
                if ($image5 != "") {
                    $image_name_parts = explode('.', $image5);
                    $ext = end($image_name_parts);

                    //create new name for image
                    $image5 = "restaurantName_" . rand(0000, 9999) . "." . $ext;
                        //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image.
                    $src = $_FILES['image5']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../restaurant-img/" . $image5;

                    //finally uploaded the image.
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image upload or not.
                    if ($upload == false) {
                        //faild to upload image
                        //redirect to upload the image.
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image5 = "";  //setting default value is blanks

            }

            //3. insert to data in database.
            $sql2 = "INSERT INTO `tbl_add_restaurant`(`title`, `description`, `price`, `image`, `image1`, `image2`, `image3`, `image4`, `image5`, `category`, `featured`, `active`) VALUES ('$title','$description','$price','$image','$image1','$image2','$image3','$image4','$image5','$category','$featured','$active')";

// image  image1  image2 image3 image4 image5

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //4.redirect with message to manage food.
            if ($res2 == true) {
                //data insert succesfully
                $_SESSION['add'] = "<div class='success'>food added successfully.</div>";
                // header('location:' . SITEURL . 'admin/add-food.php');
            } else {
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>failed to add food.</div>";
                header('location:' . SITEURL . 'admin/add-food.php');
            }
        } else {
            // echo"button not click";
        }
        ?>

    </div>
</div>

<?php include('partilas/footer.php'); ?>