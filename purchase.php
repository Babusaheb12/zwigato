<?php
include('config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['purchase'])) {
        $query1 = "INSERT INTO `tbl_order_manager`(`full_name`, `phone_no`, `email`, `address`) VALUES ('$_POST[fullname]','$_POST[phone_no]','$_POST[email]','$_POST[address]')";

        if (mysqli_query($conn, $query1)) {
            $order = mysqli_insert_id($conn);

            $query2 = "INSERT INTO `tbl_order`(`order_id`, `item_name`, `price`, `qty`) VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query2);
            if ($stmt) {
                foreach ($_SESSION['shopping_cart'] as $key => $value) {
                    $item_name = $value['product_name'];
                    $price = $value['product_price'];
                    $qty = $value['product_quantity'];

                    mysqli_stmt_bind_param($stmt, "issi", $order, $item_name, $price, $qty);
                    mysqli_stmt_execute($stmt);
                }
                unset($_SESSION['shopping_cart']);
                echo "<script>
                    alert('Order placed');
                    window.location.href='addToCart.php';
                </script>";
            } else {
                echo "<script>
                    alert('SQL query prepare error');
                    window.location.href='addToCart.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('SQL error');
                window.location.href='addToCart.php';
            </script>";
        }
    } else {
        // echo "not submit";
    }
}

?>
