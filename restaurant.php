<?php include('partials-front\menu.php');
?>

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
                        <h3><?php echo $price; ?></h3>
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





<?php include('partials-front\footer.php'); ?>