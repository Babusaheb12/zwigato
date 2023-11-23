<?php include('partials-front\menu.php');

// Initialize variables with default values
$category_id = "";
$res2 = null;

// Check whether 'category_id' is set in the URL
if (isset($_GET['category'])) {
    $category_id = $_GET['category'];

    // Query to fetch category title based on category ID
    $sql = "SELECT title FROM tbl_category_restaurant WHERE id = $category_id";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $category = $row['title'];
    }

    // Query to fetch food items based on the selected category
    $sql2 = "SELECT * FROM tbl_add_restaurant WHERE category = $category_id";
    $res2 = mysqli_query($conn, $sql2);
}
?>

<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
    <h2>restaurant <a href="#" class="text-white">"<?php echo $category; ?>"</a></h2>
    </div>
</section>
<!-- End restaurant search  -->

<!--Menu-->

<div class="menu" id="Menu">
    <h1>Our<span>search</span></h1>

    <div class="menu_box">


        <?php
        if ($res2 && mysqli_num_rows($res2) > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image = $row2['image'];
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

                            <!-- <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i> -->
                        </div>
                        <br>
                        <a href="<?php echo SITEURL; ?>explore-restaurant.php?restaurant_id=<?php echo $id; ?>" class="menu_btn">Book Now</a>

                    </div>


                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food not available for this category.</div>";
        }
        ?>


    </div>
    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>

</div>



<?php include('partials-front\footer.php'); ?>