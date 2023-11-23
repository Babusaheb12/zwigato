<?php include('partials-front\menu.php');
?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!--category-->

<div class="gallary" id="Gallary">
    <h1>Our<span>categories</span></h1>
    <div class="gallary_image_box">
        <?php

        //create a query to display category from database.
        $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 6";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //count row to check whether the category is available
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //category AVAILABLE.
            while ($row = mysqli_fetch_assoc($res)) {
                //grt the value like id,title,image_name.
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="gallary_image">
                        <?php
                        if ($image_name == "") {
                            // Display message when image is not available
                            echo "Image not Available.";
                        } else {
                            // Display the image when it is available
                            echo '<img src="' . SITEURL . 'images/category/' . $image_name . '" width="200" height="300">';
                        }
                        ?>



                        <h5 class="gallary_btn"><?php echo $title; ?></h5>
                    </div>
                </a>
        <?php
            }
        } else {
            //category not available
            echo "<div class='error'>category not available</div>";
        }
        ?>

    </div>
    <p class="text-center">
        <a href="categories.php">See All categories</a>
    </p>

</div>


<!-- end category -->

<!--food-->

<div class="menu" id="Menu">
    <h1>Our<span>foods</span></h1>
    <div class="menu_box">

        <?php
        // Getting Foods from the database that are active and featured

        // SQL query
        $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 12";

        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        // Count rows
        $count2 = mysqli_num_rows($res2);

        // Check whether food is available or not
        if ($count2 > 0) {
            // Food available
            while ($row = mysqli_fetch_assoc($res2)) {
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
                            // Check if the image is available or not
                            if ($image_name == "") {
                                // Image not available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                // Image available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="food image">
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
                            <h3><?php echo $price; ?></h3>
                            <!-- star -->

                            <!-- <div class="ratting">
                                4.3
                                <img class="_1wB99o" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMyIgaGVpZ2h0PSIxMiI+PHBhdGggZmlsbD0iI0ZGRiIgZD0iTTYuNSA5LjQzOWwtMy42NzQgMi4yMy45NC00LjI2LTMuMjEtMi44ODMgNC4yNTQtLjQwNEw2LjUuMTEybDEuNjkgNC4wMSA0LjI1NC40MDQtMy4yMSAyLjg4Mi45NCA0LjI2eiIvPjwvc3ZnPg==">

                            </div> -->

                            <!-- end star -->
                            <div class="menu_icon">

                                <!-- <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i> -->

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
            echo "<div class='error'>Food not available</div>";
        }
        ?>



    </div>
    <br>
    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>


</div>

<div class="gallary" id="Gallary">
    <h1>categories<span>Restaurant</span></h1>

    <div class="gallary_image_box">



        <?php
        $sql3 = "SELECT * FROM tbl_category_restaurant WHERE active='yes' AND featured='yes' LIMIT 6";

        //execute the query.
        $res3 = mysqli_query($conn, $sql3);

        //count row to check whether the category is available.
        $count3 = mysqli_num_rows($res3);

        if ($count3 > 0) {

            //category available.
            while ($row = mysqli_fetch_assoc($res3)) {
                //get the value like id, title ,image.
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                $description = $row['description'];

        ?>
                <div class="gallary_image">

                    <!-- image_name description -->
                    <?php
                    if ($image_name == "") {
                        echo "No Image Found!";
                    } else {

                        // Display the image when it is available
                        echo '<img src="' . SITEURL . 'restaurant-img\category-restaurant/' . $image_name . '" width="200" height="300">';
                    }
                    ?>


                    <h3><?php echo $title; ?></h3>
                    <p> <?php echo $description;  ?></p>
                    <a href="restaurant-category.php?category=<?php echo $id; ?>" class="gallary_btn">Order Now</a>
                </div>

        <?php
            }
        } else {
            //category not available
            echo "<div class='error'>category not available</div>";
        }
        ?>
    </div>
    
</div>

<!-- all restaurants -->
<div class="menu" id="Menu">
    <h1>Our<span>Restaurant</span></h1>

    <div class="menu_box">
        <?php

        $sql4 = "SELECT * FROM tbl_add_restaurant WHERE active='yes' AND featured='yes'";

        //Execute the query.
        $res4 = mysqli_query($conn, $sql4);

        //count rows.
        $count4 = mysqli_num_rows($res4);

        //check the whether restaurant is available or not.
        if ($count4 > 0) {
            while ($row = mysqli_fetch_assoc($res4)) {

                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image = $row['image'];
                $image1 = $row['image1'];
                $image2 = $row['image2'];
                $image3 = $row['image3'];
                $image4 = $row['image4'];
                $image5 = $row['image5'];

        ?>
                <div class="menu_card">

                    <div class="menu_image">
                        <?php
                        //check the image is available or not.
                        if ($image == "") {
                            // Image not available
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>restaurant-img/<?php echo $image; ?>">
                        <?php
                        }
                        ?>

                    </div>

                    <div class="small_card">
                        <div class="ratting">
                            4.3
                            <img class="_1wB99o" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMyIgaGVpZ2h0PSIxMiI+PHBhdGggZmlsbD0iI0ZGRiIgZD0iTTYuNSA5LjQzOWwtMy42NzQgMi4yMy45NC00LjI2LTMuMjEtMi44ODMgNC4yNTQtLjQwNEw2LjUuMTEybDEuNjkgNC4wMSA0LjI1NC40MDQtMy4yMSAyLjg4Mi45NCA0LjI2eiIvPjwvc3ZnPg==">

                        </div>
                        <!-- <i class="fa-solid fa-heart"></i> -->
                    </div>

                    <div class="menu_info">
                        <h2><?php echo $title; ?></h2>
                        <p>
                            <?php echo $description; ?>
                        </p>
                        <h3>₹ <?php echo $price; ?></h3>
                        <div class="menu_icon">
                            <br>
                            <!-- <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i> -->
                        </div>
                        <a href="<?php echo SITEURL; ?>explore-restaurant.php?restaurant_id=<?php echo $id; ?>" class="menu_btn">Book Now</a>


                    </div>


                </div>

        <?php

            }
        }
        ?>

    </div>

</div>




<!--Team-->

<!-- <div class="team">
    <h1>Our<span>Team</span></h1>

    <div class="team_box">
        <div class="profile">
            <img src="images\ujjawal.jpg">

            <div class="info">
                <h2 class="name">Ujjawal Roy</h2>
                <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                <div class="team_icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>

            </div>

        </div>

        <div class="profile">
            <img src="images\babu saheb 2.png">

            <div class="info">
                <h2 class="name">Babu Saheb</h2>
                <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                <div class="team_icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>

            </div>

        </div>



        <div class="profile">
            <img src="images\akash.png">

            <div class="info">
                <h2 class="name">Akash</h2>
                <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                <div class="team_icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>

            </div>

        </div>

    </div>

</div> -->


<?php include('partials-front\footer.php'); ?>