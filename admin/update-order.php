<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>update the order</h1>
        <br><br>

        <?php
        // Check whether 'id' is set or not.
        if (isset($_GET['id'])) {
            // Get the order details
            $id = $_GET['id'];

            // SQL query to get the order details
            $sql = "SELECT * FROM tbl_order WHERE id = $id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if the query was executed successfully
            if ($res) {
                // Check if data is available
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    // Details are available, fetch them
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {
                    // Details not available, redirect to manage order page
                    header('location: ' . SITEURL . 'admin/manage-order.php');
                    exit; // Stop further execution
                }
            } else {
                // Query execution failed, handle the error or redirect as needed
                echo "Error: " . mysqli_error($conn);
                // You can also redirect here if you want
                // header('location: ' . SITEURL . 'admin/manage-order.php');
                exit; // Stop further execution
            }
        } else {
            // Redirect to manage admin page if 'id' is not set
            header('location: ' . SITEURL . 'admin/manage-order.php');
            exit; // Stop further execution
        }
        ?>

        <form action="" method="post">

            <table class="tbl-31">
                <tr>
                    <td>food name</td>
                    <td> <b><?php echo $food; ?> </b></td>
                </tr>

                <tr>
                    <td>price:</td>
                    <td>
                        <b> &#x20b9 <?php echo $price; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "order") echo "selected"; ?> value="Ordered">ordered</option>

                            <option <?php if ($status == "On Delivery") echo "selected"; ?> value="On Delivery">On Delivery</option>

                            <option <?php if ($status == "Delivered") echo "selected"; ?> value="Delivered">Delivered</option>

                            <option <?php if ($status == "Cancelled") echo "selected"; ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer name:</td>
                    <td>
                        <input type="text" name="Customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer contact:</td>
                    <td>
                        <input type="text" name="Customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer email::</td>
                    <td>
                        <input type="text" name="Customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer address:</td>
                    <td>
                        <textarea name="Customer_address" id="" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update order" class="btn-danger">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        // Check whether update button is clicked or not
        if (isset($_POST['submit'])) {
            // Get all the values from the form
            $id = $_POST['id'];
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $customer_name = $_POST['Customer_name'];
            $customer_contact = $_POST['Customer_contact'];
            $customer_email = $_POST['Customer_email'];
            $customer_address = $_POST['Customer_address'];

            // Update the value.
            $sql2 = "UPDATE tbl_order SET
                qty = $qty,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id = $id";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether updated or not.
            if ($res2) {
                // Update successful
                $_SESSION['update'] = "<div class='success'>Order updated successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
                exit; // Stop further execution
            } else {
                // Update failed
                $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
                header('location: ' . SITEURL . 'admin/manage-order.php');
                exit; // Stop further execution
            }
        }
        ?>

    </div>
</div>

<?php include('partilas/footer.php'); ?>
