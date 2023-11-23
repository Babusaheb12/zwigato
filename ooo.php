<?php include('partials-front/menu.php'); ?>

<?php
// Check if 'food_id' is set in the URL
if (isset($_GET['food_id'])) {
    // Get the food ID and details of the selected food
    $food_id = $_GET['food_id'];

    // Get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Count the rows
    $count = mysqli_num_rows($res);

    // Check if the data is available
    if ($count == 1) {
        // We have data, get the data from the database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // Food not available, redirect to the home page
        header('location: ' . SITEURL);
        exit; // Add an exit to stop further execution
    }
} else {
    // Redirect to a message if 'food_id' is not set
    header('location: ' . SITEURL);
    exit; // Add an exit to stop further execution
}
?>

<!-- Food Search Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    // Check if the image is available
                    if (!empty($image_name)) {
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    <?php
                    } else {
                        // Image not available
                        echo "<div class='error'>Image not available</div>";
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">&#x20b9 <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9534xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. xyz@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="..." class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <div class="clearfix"></div>

        <?php
        // Check if the submit button is clicked
        if (isset($_POST['submit'])) {
            // Get all the details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $order_date = date('Y-m-d H:i:s'); // Corrected the date format

            $status = "ordered";

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Insert the order into the database
            $sql2 = "INSERT INTO tbl_order SET
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                // Order placed successfully
                $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully.</div>";
                header('location: ' . SITEURL);
            } else {
                // Failed to place order
                $_SESSION['order'] = "<div class='error'>Failed to order food.</div>";
                header('location: ' . SITEURL);
            }
        }
        ?>
    </div>
    
</section>
<!-- Food Search Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
