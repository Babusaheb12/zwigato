<?php include('partials-front/menu.php'); ?>

<?php

if (isset($_POST["add"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "product_id");

        if (in_array($_GET["id"], $item_array_id)) {

            // Product already exists in the shopping cart
            echo "<script>alert('Product is already in the cart.');</script>";
        } else {
            // Product is not in the shopping cart, add it
            $item = array(
                'product_id' => $_GET["id"],
                'product_image' => $_POST["hidden_image"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'product_quantity' => $_POST["hidden_Quantity"]



            );
            $_SESSION["shopping_cart"][] = $item;
            // echo "<script>alert('Product added to cart.');</script>";
        }
    } else {
        // Create a new shopping cart session
        $item = array(
            'product_id' => $_GET["id"],
            'product_image' => $_POST["hidden_image"],
            'product_name' => $_POST["hidden_name"],
            'product_price' => $_POST["hidden_price"],
            'product_quantity' => $_POST["hidden_Quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item;
        // echo "<script>alert('Product added to cart.');</script>";
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["product_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
            }
        }
    }
} else {
    // echo "not delete";
}
?>

<div class="col-lg-15  bg-info">
    <div class="col-lg-12 text-center border rounded bg-light my-4">
        <h1>MY CART</h1>

    </div>
    <div class="container">

        <table class="table table-bordered bg-white text-center">
            <thead class="text-center">
                <tr>
                    <th scope="col">Food image</th>
                    <th scope="col">Food name</th>
                    <th scope="col">Food Quantity</th>
                    <th scope="col">Food price</th>
                    <th scope="col">total price</th>

                    <th scope="col">remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION["shopping_cart"])) {

                    $total = 0;
                    foreach ($_SESSION["shopping_cart"] as $key => $value) {
                ?>
                        <tr>
                            <td>
                                <img src="<?php echo $value['product_image']; ?>" style="height: 150px;width: 186px;" alt="Product Image">
                            </td>
                            <td><?php echo $value["product_name"]; ?></td>
                            <td><?php echo $value["product_quantity"]; ?></td>
                            <td><?php echo $value["product_price"]; ?></td>
                            <td><?php echo (floatval($value["product_quantity"])) * (floatval($value["product_price"])); ?></td>

                            <td>
                                <a href="addToCart.php?action=delete&id=<?php echo $value["product_id"] ?>">
                                    <button class='btn btn-sm btn-outline-danger'>Remove</button>
                                </a>

                            </td>
                        </tr>
                    <?php
                        $total = $total + ($value["product_quantity"] * $value["product_price"]);
                    }
                    ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            total:
                        </td>
                        <td><?php echo number_format($total, 2); ?></td>

                        <td><button class="btn bg-dark text-white" name="add_user" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Order Now</button></td>
                    </tr>




                <?php

                } else {

                    echo "
                          <script>
                          window.location.href='index.php';
                          </script>
                          ";
                }
                ?>
            </tbody>
        </table>
        <!-- </form> -->
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body ">
            <div class="order" id="Order">
                <h1><span>Order</span>Now</h1>

                <div class="order_main">

                    <div class="order_image">
                        <img src="image/order_image.png">
                    </div>

                    <form action="purchase.php" method="POST">

                        <div class="input">
                            <p>Name</p>
                            <input type="text" name="fullname" placeholder="you name">
                        </div>

                        <div class="input">
                            <p>Email</p>
                            <input type="email" name="email" placeholder="you email">
                        </div>

                        <div class="input">
                            <p>Number</p>
                            <input placeholder="you number" name="phone_no">
                        </div>

                        <div class="input">
                            <p>Price</p>
                            <input type="number" name="price" placeholder="how many order" value="<?php echo $total; ?>">
                        </div>

                        <!-- <div class="input">
                            <p>You Order</p>
                            <input placeholder="food name">
                        </div> -->

                        <div class="input">
                            <p>Address</p>
                            <textarea name="address" cols="30" rows="1" placeholder="you Address"></textarea>

                        </div>

                        <br>


                        <button class="order_btn" name="purchase">Order Now</button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <?php
    include('partials-front\footer.php');
    ?>