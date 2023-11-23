<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage All Restaurants</h1>
        <br><br>

        <!-- Button to add restaurant -->
        <a href="<?php echo SITEURL; ?>admin/add-restaurant.php" class="btn-primary">Add Restaurant</a>

        <a href="<?php echo SITEURL; ?>admin\explore-restaurant-img.php" class="btn-primary">Add image</a>

        <a href="<?php echo SITEURL; ?>admin\restaurent-menu.php" class="btn-primary">Add Menu</a>
        <br> <br> <br>
        <!-- C:\xampp\htdocs\Zwigato\admin\explore-restaurant-img.php -->
        <?php
        if (isset($_SESSION['delete'])) {
            echo ($_SESSION['delete']);
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo ($_SESSION['upload']);
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorized'])) {
            echo ($_SESSION['unauthorized']);
            unset($_SESSION['unauthorized']);
        }
        if (isset($_SESSION['update'])) {
            echo ($_SESSION['update']);
            unset($_SESSION['update']);
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S. No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Image Explore 1</th>
                <th>Image Explore 2</th>
                <th>Image Explore 3</th>
                <th>Image Explore 4</th>
                <th>Image Explore 5</th>
                <th>Featured <br> Active</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_add_restaurant";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image = $row['image'];
                    $image1 = $row['image1'];
                    $image2 = $row['image2'];
                    $image3 = $row['image3'];
                    $image4 = $row['image4'];
                    $image5 = $row['image5'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>&#x20b9 <?php echo $price; ?></td>
                        <td>
                            <?php
                            if ($image == "") {
                                echo "<div class='error'>Image not added</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image; ?>" width="100px" alt="Image">
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($image1 == "") {
                                echo "<div class='error'>Image not added</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image1; ?>" width="100px" alt="Image">
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($image2 == "") {
                                echo "<div class='error'>Image not added</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image2; ?>" width="100px" alt="Image">
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($image3 == "") {
                                echo "<div class='error'>Image not added</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image3; ?>" width="100px" alt="Image">
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($image4 == "") {
                                echo "<div class='error'>Image not added</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image4; ?>" width="100px" alt="Image">
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($image5 == "") {
                                echo "<div class='error'>Image not added</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image5; ?>" width="100px" alt="Image">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?> <br> <?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-restaurant.php?id=<?php echo $id; ?>" class="btn-secondary">Update Restaurant</a>
                            <br> <br>
                            <a href="<?php echo SITEURL; ?>admin/delete-restaurant.php?id=<?php echo $id; ?>&image=<?php echo $image; ?> &image1=<?php echo $image1; ?> &image2=<?php echo $image2; ?>&image3=<?php echo $image3; ?>&image4=<?php echo $image4; ?>&image5=<?php echo $image5; ?>" class="btn-danger">Delete Restaurant</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='11' class='error'>No restaurant added yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partilas/footer.php'); ?>



<!-- $id  id'
                    
                    $image = $row['image'];
                    $image1 = $row['image1'];
                    $image2 = $row['image2'];
                    $image3 = $row['image3'];
                    $image4 = $row['image4'];
                    $image5 = $row['image5']; -->