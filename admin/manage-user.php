<?php include('partilas/menu.php'); ?>

<!-- Menu content section started -->
<div class="main-content">
    <div class="wrapper">
        <h1>register user</h1>
        <br> <br>

        <table class="tbl-full">
            <tr>
                <th>S. No.</th>
                <th>Name</th>
                <th>Address</th>
                <th>phone number</th>
                <th>email</th>
                <th>is_verified</th>
            </tr>

            <?php
            $sql = "SELECT * FROM register_user";

            //execute the query
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                //count rows to check the database has data or not.
                $count = mysqli_num_rows($res); //function to get all the data in the database
                if ($count > 0) {
                    $n = 1; // Initialize the counter
                    while ($row = mysqli_fetch_assoc($res)) {
                        //get individual data
                        $id = $row['id'];
                        $name = $row['name'];
                        $address = $row['address'];
                        $phone_number = $row['phone_number'];
                        $email = $row['email'];
                        $is_verified = $row['is_verified'];


                        //display the table
            ?>
                        <tr>
                            <td><?php echo $n++ ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $address ?></td>
                            <td><?php echo $phone_number ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $is_verified ?></td>
                        </tr>
            <?php
                    }
                } else {
                    // No data in the database
                }
            } // Close the if ($res == true) block here
            ?>
        </table>
    </div>
</div>
<!-- menu content section end -->
<?php
include('partilas/footer.php');
?>
