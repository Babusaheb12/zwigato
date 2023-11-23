<?php include('partilas/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>manage order</h1>

        <br><br><br>

        <?php
        if(isset($_SESSION['update']))
        {
            echo ($_SESSION['update']);
            unset($_SESSION['update']);
        }
        ?>
        <br><br>
        <table class="tbl-full">
        <tr>
                <th style=" width: 5%;"> S. No. </th>
                <th style=" width: 5%;"> food </th>
                <th style=" width: 5%;"> price </th>
                <th style=" width: 5%;"> qty </th>
                <th style=" width: 5%;"> total </th>
                <th style=" width: 5%;"> order date </th>
                <th style=" width: 5%;"> status </th>
                <th style=" width: 5%;"> customer name </th>
                <th style=" width: 5%;"> contact </th>
                <th style=" width: 5%;"> email </th>
                <th style=" width: 5%;"> address </th>
                <th style=" width: 5%;"> action </th>
            </tr>
            <?php
            //get all the order from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //desplay the latest order at first
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);
            $sn = 1;   //create a serial number set an initial value.

            if ($count > 0) {
                //order available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get all the order details.
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact']; // Corrected variable name
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
            ?>
                    <tr>
                        <td> <?php echo $sn++; ?> </td>
                        <td style=" width: 12%;"> <?php echo $food; ?> </td>
                        <td style=" width: 7%;"> <?php echo $price; ?> </td>
                        <td> <?php echo $qty; ?> </td>
                        <td style=" width: 7%;"> <?php echo $total; ?> </td>
                        <td style=" width: 5%;"> <?php echo $order_date; ?> </td>
                        <td style=" width: 7%;">
                        <?php
                         // order on delivery and delivered
                         if ($status == "Ordered") {
                             echo "<label>$status</label>";
                         }
                         if ($status == "On Delivery") {
                             echo "<label style='color: orange;'>$status</label>";
                         }
                         if ($status == "Delivered") {
                             echo "<label style='color: green;'>$status</label>";
                         }
                         if ($status == "Cancelled") {
                             echo "<label style='color: red;'>$status</label>";
                         }
                         ?>
                        </td>
                        <td style=" width: 9%;"> <?php echo $customer_name; ?> </td>
                        <td style=" width: 5%;"> <?php echo $customer_contact; ?> </td>
                        <td style=" width: 5%;"> <?php echo $customer_email; ?> </td>
                        <td style=" width: 5%;"> <?php echo $customer_address; ?> </td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin\update-order.php?id=<?php echo $id; ?>" class="btn-danger">update</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //order not available
                echo "<td colspan='12' class='error'>No Order Available!</td>";
            }
            ?>
        </table>
    </div>
</div>

<?php
include('partilas/footer.php');
?>
