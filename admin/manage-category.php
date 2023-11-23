<?php include('partilas/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>manage category</h1>
        <br> <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo ($_SESSION['remove']);
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo ($_SESSION['delete']);
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo ($_SESSION['no-category-found']);
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo ($_SESSION['update']);
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo ($_SESSION['upload']);
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed remove'])) {
            echo ($_SESSION['failed remove']);
            unset($_SESSION['failed remove']);
        }
        ?>
        <br><br>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL; ?>admin\add-category.php" class="btn-primary">add category</a>

        <br> <br> <br>




        <table class="tbl-full">
            <tr>
                <th>S. No.</th>
                <th>title</th>
                <th>image</th>
                <th>image name</th>
                <th>featured</th>
                <th>active</th>
                <th>action</th>
            </tr>
            <?php

            //query to get all category from database
            $sql = "SELECT * FROM tbl_category";

            //Execute Query
            $res = mysqli_query($conn, $sql);


            //count rows
            $count = mysqli_num_rows($res);

            //create a number variable and assign a value as 1
            $sn = 1;


            //check whether we have data in database
            if ($count > 0) {
                //the data have database
                //get the data in display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            // Check whether image name is available or not.
                            if ($image != "") {
                                // Display the image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image; ?>" width="100px" alt="Category Image">
                            <?php
                            } else {
                                // Display a default image or a message
                                echo "<div class='error'>Image not added</div>";
                            }
                            ?>
                        </td>


                        <td><?php echo $image; ?></td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>

                            <a href="<?php echo SITEURL; ?>admin\update-category.php?id=<?php echo $id; ?>" class="btn-secondary" class="btn-danger">update category</a>

                            <a href="<?php echo SITEURL; ?>admin\delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn-danger" class="btn-danger">delete category</a>



                        </td>
                    </tr>

                <?php
                }
            } else {
                //we do not data in database

                //we will display message in database
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">no category add</div>
                    </td>
                </tr>
            <?php
            }
            ?>


        </table>
    </div>
</div>

<?php
include('partilas/footer.php');
?>