<?php
include('partilas/menu.php');
?>

<!-- Menu content section started -->
<div class="main-content">
    <div class="wrapper">
        <h1>manage admin</h1>
        <br> <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Desplaying session message
            unset($_SESSION['add']); //Removing session message
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']); 
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']); // Clear the session variable
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']); 
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']); 
        }
        ?>
        <br> <br>


        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">add admin</a>
        <br> <br> <br>




        <table class="tbl-full">
            <tr>
                <th>S. No.</th>
                <th>full name</th>
                <th>username</th>
                <th>action</th>
            </tr>

            <?php

            //Query to get admin

            $sql = "SELECT * FROM tbl_admin";

            //Execute the Query 

            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                //count rows to check whether we have data in database or not

                $count = mysqli_num_rows($res);  //function to get all the rows in database
                $sn=1;  //create a variable and assign the value 
                //click the num of rows
                if ($count > 0) {
                    //we can have a data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data  from database.
                        //add while loop will run as long as we have data in database

                        //Get individul data 
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //DIsplay the value in our table

            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>

                            <td>
                                <a href="<?php echo SITEURL;?>admin\update-password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>


                                <a href="<?php echo SITEURL;?>admin\update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">update admin</a>


                                <a href="<?php echo SITEURL;?>admin\delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">delete admin</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //we do not have data in database
                }
            }
            ?>

        </table>

        <!-- <div class="clearefix"></div> -->

    </div>
</div>
<!-- menu contant section end -->

<?php
include('partilas/footer.php');
?>