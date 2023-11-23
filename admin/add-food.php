<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br> <br>

        <?php

        if (isset($_SESSION['upload'])) {
            echo ($_SESSION['upload']);
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>title: </td>
                    <td>
                        <input type="text" name="title" placeholder="title of the food">
                    </td>
                </tr>

                <tr>
                    <td>description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="something about food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>price:</td>
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
                    <td>category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // Create PHP code to display categories from the database

                            // 1. Create SQL to get all active categories from the database
                            $sql = "SELECT * FROM tbl_category WHERE active = 'yes'";

                            // Execute the query.
                            $res = mysqli_query($conn, $sql);

                            // Check if there are categories
                            if ($res) {
                                // We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // Get the details of the category
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                // Error in executing the query or no categories found
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
                        <input type="submit" name="submit" value="add food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //check whether a button is click or not
        if (isset($_POST['submit'])) {
            //add the food in database
            // echo "add food";
            //1. get the data from 

            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio button for feature and active are checked or not.
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "no";  //setting the default value
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "no";  //setting default value. 
            }
            //upload the image if selected

            //check whether the select image is clicked or not if the image is selected
            if (isset($_FILES['image']['name'])) {
                //get the details of the selected image.
                $image_name = $_FILES['image']['name'];

                //check whether the image is selected or not and upload the image only if selected
                if ($image_name != "") {
                    //image selected
                    //A. rename the image.
                    //get the extension of selected image(jpg ,png, gif,aiv.etc)

                    //get the extension of selected image(jpg ,png, gif,aiv.etc)
                    $image_name_parts = explode('.', $image_name);
                    $ext = end($image_name_parts);



                    //create new name for image
                    $image_name = "Food Name" . rand(0000, 9999) . "." . $ext; //like new image may be "Food name"

                    //upload image
                    //source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image is uploaded
                    $dst = "../images/food/" . $image_name;

                    //finally upload the food page
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image uploaded or not.
                    if ($upload == false) {
                        //failed to upload the image 
                        //redirect to add food
                        $_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
                        //stop the process
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; //setting default value is blanks.
            }
            //3. insert into database.
            //create a sql query to save or add food
            //for numerical value we do not pass value inside **But for string value it is compulsary to add quates.
            $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) 
         VALUES ('$title', '$description', '$price', '$image_name', '$category', '$featured', '$active')";




            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //4.redirect with message to manage food.
            if ($res2 == true) {
                //data insert succesfully
                $_SESSION['adda'] = "<div class='success'>food added successfully.</div>";
                // header('location:' . SITEURL . 'admin/add-food.php');
            } else {
                //failed to insert data
                $_SESSION['adda'] = "<div class='error'>failed to add food.</div>";
                header('location:' . SITEURL . 'admin/add-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partilas/footer.php'); ?>

