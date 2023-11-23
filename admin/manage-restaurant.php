<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Restaurant Category</h1>
        <br><br>

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
        <br> <br><br>

        <!-- Button to add restaurant category -->
        <a href="<?php echo SITEURL; ?>admin/add-restaurant-category.php" class="btn-primary">Add Restaurant Category</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Image Name</th>
                <th>Description</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            // Query to get all category from the database
            $sql = "SELECT * FROM `tbl_category_restaurant`";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count rows
            $count = mysqli_num_rows($res);

            // Create a serial number variable and initialize it to 1
            $sn = 1;

            // Check whether there is data in the database
            if ($count > 0) {
                // Data exists in the database, so display it
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $imgname = $row['image_name'];
                    $description = $row['description'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            // Check whether image name is available or not
                            if ($imgname != "") {
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/category-restaurant/<?php echo $imgname; ?>" width="100px" alt="Restaurant Image">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $imgname; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>admin\update-restaurant-category.php?id=<?php echo $id; ?>" class="btn-secondary">update category</a>

                            <a href="<?php echo SITEURL; ?>admin/delete-restaurant-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn-danger" class="btn-danger">delete category</a>
                            
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="8">
                        <div class="error">No data found.</div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<?php include('partilas/footer.php'); ?>
