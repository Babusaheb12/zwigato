<?php
include('partilas/menu.php');
?>

<!-- Menu content section started -->
<div class="main-content">
    <div class="wrapper">
        <h1>dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login.php'])) {
            echo $_SESSION['login.php'];
            unset($_SESSION['login']);
        }

        ?>
        <br><br>

        <div class="col-4 text-center">
            <?php
            //sql query

            $sql = "SELECT * FROM tbl_category";
            //execute query
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br>
            categores
        </div>


        <div class="col-4 text-center">

            <?php
            //sql query

            $sql2 = "SELECT * FROM tbl_food";
            //execute query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            foods
        </div>


        <div class="col-4 text-center">

            <?php
            //sql query

            $sql3 = "SELECT * FROM tbl_order";
            //execute query
            $res3 = mysqli_query($conn, $sql3);
            //count rows
            $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br>
            total orders
        </div>

        <div class="col-4 text-center">
           
        </div>
        <div class="clearefix"></div>

    </div>
</div>
<!-- menu contant section end -->

<?php
include('partilas/footer.php');
?>