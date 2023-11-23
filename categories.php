<?php include('partials-front\menu.php'); ?>

<!--Gallary-->

<div class="gallary" id="Gallary">
    <h1>Our<span>categories</span></h1>

    <div class="gallary_image_box">

        <?php
        // Display all the categories that are active
        // SQL query
        $sql = "SELECT * FROM tbl_category WHERE active='yes'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Count rows
        $count = mysqli_num_rows($res);

        // Check whether categories are available or not
        if ($count > 0) {
            // Categories available
            while ($row = mysqli_fetch_assoc($res)) {
                // Get all the values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

                // Construct the category item link
                echo '<a href="category-foods.php?category_id=' . $id . '">';
                echo '<div class="gallary_image">';

                if (empty($image_name)) {
                    // Image not available
                    echo "<div class='error'>Image not found.</div>";
                } else {
                    // Image available
                    echo '<img src="' . SITEURL . 'images/category/' . $image_name . '" alt="Image" width="200" height="300">';
                }

                echo '<h3 class="gallary_btn">' . $title . '</h3>';
                echo '</div></a>';
            }
        } else {
            // Categories not available
            echo "<div class='error'>Categories not found.</div>";
        }
        ?>






    </div>
    

</div>

<?php include('partials-front\footer.php'); ?>