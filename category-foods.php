<?php include('partials-front\menu.php');

// Initialize variables with default values
$category_title = "";
$res2 = null;

// Check whether 'category_id' is set in the URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Query to fetch category title based on category ID
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }

    // Query to fetch food items based on the selected category
    $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
    $res2 = mysqli_query($conn, $sql2);
}
?>

<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods in <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>

<!--Menu-->

<div class="menu" id="Menu">
    <h1>Our<span>search</span></h1>

    <div class="menu_box">


        <?php
        if ($res2 && mysqli_num_rows($res2) > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $food_id = $row2['id'];
                $food_title = $row2['title'];
                $food_price = $row2['price'];
                $food_description = $row2['description'];
                $food_image = $row2['image_name'];
        ?>

                <div class="menu_card">
                    <form method="post" action="addToCart.php?action=add&id=<?php echo $id; ?>">
                        <div class="menu_image">


                            <?php if (!empty($food_image)) { ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $food_image; ?>" alt="<?php echo $food_title; ?>">
                            <?php
                            } else {
                            ?>
                                <div class='error'>Image not available.</div>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="small_card">
                            <i class="fa-solid fa-heart"></i>
                        </div>

                        <div class="menu_info">
                            <h2><?php echo $food_title; ?></h2>
                            <p>
                                <?php echo $food_description; ?>
                            </p>
                            <h3>&#x20b9 <?php echo $food_price; ?></h3>
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
                                        <input type="hidden" name="hidden_image" value="<?php echo SITEURL; ?>images/food/<?php echo $food_image; ?>">
                                        <input type="hidden" name="hidden_name" value="<?php echo $food_title; ?>">
                                        <input type="hidden" name="hidden_price" value="<?php echo $food_price; ?>">
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
            echo "<div class='error'>Food not available for this category.</div>";
        }
        ?>


    </div>
    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>

</div>

<?php include('partials-front\footer.php'); ?>