<?php include ('partials-front\menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        // Check if the search key is set
        if (isset($_POST['search'])) {
            // Get the search keyword
            $search = $_POST['search'];
        } else {
            // Default value if 'search' is not set
            $search = "";
        }
        ?>
        <h2>Foods on Your Search <a href="index.php" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

    <!--Menu-->

    <div class="menu" id="Menu">
        <h1>Our<span>search</span></h1>

        <div class="menu_box">


        <?php
        // Check if 'search' is set before using it in the SQL query
        if (isset($search)) {
            // SQL query to find foods based on search keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count rows
            $count = mysqli_num_rows($res);

            // Check whether food is available or not
            if ($count > 0) {
                // Food available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>



            <div class="menu_card">
            <form method="post" action="addToCart.php?action=add&id=<?php echo $id; ?>">
                <div class="menu_image">

                <?php
                            // Check whether image name is available or not
                            if ($image_name == "") {
                                // Image not available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                // Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                     alt="image">
                                <?php
                            }
                            ?>
                </div>

                <div class="small_card">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <div class="menu_info">
                    <h2><?php echo $title; ?></h2>
                    <p>
                    <?php echo $description; ?>
                    </p>
                    <h3>&#x20b9 <?php echo $price; ?></h3>
                    <div class="menu_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <table>
                                <tr>

                                    <td><input type="number" id="quantity" style="width: 54px; margin: 0px 0px 0px 22px;background-color: antiquewhite;" name="hidden_Quantity" value="1">
                                        <input type="hidden" name="hidden_image" value="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>">
                                        <input type="hidden" name="hidden_name" value="<?php echo $title; ?>">
                                        <input type="hidden" name="hidden_price" value="<?php echo $price; ?>">
                                        <input type="submit" class="menu_btn" name="add" value="Add to cart">

                                    </td>
                                </tr>
                            </table>
                </div>
            </form>

            </div>

            <?php
                }
            } else {
                // Food not available
                echo "<div class='error'>Food not found</div>";
            }
        }
        ?>

            

        </div>

    </div>


<?php include ('partials-front\footer.php'); ?>