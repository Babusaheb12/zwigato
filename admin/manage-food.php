<?php include('partilas/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>manage food</h1>
        <br> <br>

        <!-- Button to add admin -->
        <a href="<?php echo SITEURL; ?>admin\add-food.php" class="btn-primary">add Food</a>
        <br> <br> <br>

        <?php
        if (isset($_SESSION['delete'])) 
        {
            echo ($_SESSION['delete']);
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['upload']))
        {
            echo ($_SESSION['upload']);
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unautorized']))
        {
            echo ($_SESSION['unautorized']);
            unset($_SESSION['unautorized']);
        }
        if(isset($_SESSION['update']))
        {
            echo ($_SESSION['update']);
            unset ($_SESSION['update']);
        }
        ?>



        <table class="tbl-full">
            <tr>
                <th>S. No.</th>
                <th>title</th>
                <th>price</th>
                <th>image</th>
                <th>featured</th>
                <th>active</th>
                <th>action</th>
            </tr>

            <?php
            //create a sql query to get all the food 
            $sql = "SELECT *FROM tbl_food";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows to check whether we have food or not
            $count = mysqli_num_rows($res);

            //create serial number variable and set default value is one
            $sn = 1;

            if ($count > 0) {
                //we have from database
                //get the food from database
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the value in individual column
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>&#x20b9 <?php echo $price; ?></td>
                        <td>
                            <?php
                            // Check whether we have an image or not
                            if ($image_name == "") {
                                // We do not have an image, display an error message
                                echo "<div class='error'>image not added</div>";
                            } else {
                                // We have an image, display the image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" alt="image">
                            <?php
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="<?php echo SITEURL;?>admin\update-food.php?id=<?php echo $id;?>" class="btn-secondary">update food</a>

                            <a href="<?php echo SITEURL;?>admin\delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">delete food</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //food not add to databases
                echo "<tr><td colspan='7' class='error'>food not added yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php
include('partilas/footer.php');
?>

