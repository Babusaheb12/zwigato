<?php include('config\constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zwigato Website</title>
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <section id="Home">
        <nav>
            <div class="logo">
                <img src="images\logo.jpg">
            </div>



            <div class="sign-in-up icon">


                <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {


                    echo " 
                    <a href='logout.php' class='logout'>{$_SESSION['name']}</a>";
                } else {
                    // echo"not login";
                    echo '
                     <button type="button" onclick="popup(\'login-popup\')">LOGIN</button>
                     <button type="button" onclick="popup(\'register-popup\')">REGISTER</button>
                     ';
                }

                ?>
            </div>
        </nav>
        <br><br> <br>



        <section class="food-search text-center">
            <div class="container">
            </div>
        </section>

        <div class="popup-control" id="login-popup">
            <div class="popup">

                <form action="login_register.php" method="POST">
                    <h2>
                        <span>USER LOGIN </span>
                        <BUtton type="reset" onclick="popup('login-popup')">X</BUtton>
                    </h2>
                    <input type="email" placeholder="E-mail id " name="email_phone_number">
                    <br>
                    <button type="submit" class="login-btn" name="login">LOGIN</button>
                </form>
            </div>

        </div>

        <div class="popup-control" id="register-popup">
            <div class="register popup">

                <form action="login_register.php" method="POST">
                    <h2>
                        <span>USER REGISTER </span>
                        <BUtton type="reset" onclick="popup('register-popup')">X</BUtton>
                    </h2>
                    <input type="text" placeholder="Name" name="Name" required>

                    <input type="tel" name="phone_number" placeholder="Phone_Number" required>
                    <input type="email" name="email" placeholder="Email" required>

                    <textarea name="address" rows="3" placeholder="address" class="input-responsive" required></textarea>
                    <br>
                    <button type="submit" class="register-btn" name="register">REGISTER</button>
                </form>
            </div>

        </div>

    </section>

    <script>
        function popup(popup_name) {
            get_popup = document.getElementById(popup_name);
            if (get_popup.style.display == "flex") {
                get_popup.style.display = "none"; // Use a single equal here for assignment
            } else {
                get_popup.style.display = "flex"; // Use a single equal here for assignment
            }
        }
    </script>
    <br><br>
    <!-- <br>  <br> <br> -->

    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        // echo "<h1>Welcome to Zwigato - {$_SESSION['name']}</h1>";
    }

    ?>


    <section id="Home">
        <div class="main">

            <div class="men_text">
                <h1>Get Fresh<span>Food</span><br>in a Easy Way</h1>
            </div>

            <div class="main_image">
                <img src="image/main_img.png">
            </div>

        </div>

        <p>
        Getting fresh food in an easy way is now more convenient than ever. With the advent of online grocery shopping and home delivery services, you can have a wide variety of fresh produce, meats, and other food items delivered right to your doorstep. Many grocery stores and specialized food delivery companies offer user-friendly apps and websites, making it a breeze to browse, select, and order your favorite fresh ingredients. This not only saves time but also ensures that you have access to high-quality, nutritious food without the hassle of visiting a physical store. Whether it's fruits and vegetables or artisanal cheeses and gourmet meats, the world of fresh food is just a few clicks away.
        </p>

        <div class="main_btn">
            <a href="#">Order Now</a>
            <i class="fa-solid fa-angle-right"></i>
        </div>

    </section>



    <!--About-->

    <div class="about" id="About">
        <div class="about_main">

            <div class="image">
                <img src="image/Food-Plate.png">
            </div>

            <div class="about_text">
                <h1><span>About</span>Us</h1>
                <h3>Why Choose us?</h3>
                <p>
                Choosing us is the ideal decision for those seeking unparalleled expertise and a commitment to excellence. Our dedication to customer satisfaction is unwavering, as we prioritize your needs above all else. We stand out through our exceptional quality, reliability, and a passion for innovation. Our team consists of industry leaders who are driven to deliver exceptional results, whether in products or services. We value transparency and integrity in all our dealings, fostering trust with our clients. When you choose us, you're choosing a partner that understands your unique requirements and is dedicated to providing tailored solutions that surpass expectations. Join us on a journey of exceptional experiences, where your satisfaction is our ultimate goal
                </p>
            </div>

        </div>

        <a href="#" class="about_btn">Order Now</a>

    </div>

    <!--Gallary-->

    <div class="gallary" id="Gallary">
    <h1>Our<span>categories</span></h1>
    <div class="gallary_image_box">
        <?php

        //create a query to display category from database.
        $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 6";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //count row to check whether the category is available
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //category AVAILABLE.
            while ($row = mysqli_fetch_assoc($res)) {
                //grt the value like id,title,image_name.
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="gallary_image">
                        <?php
                        if ($image_name == "") {
                            // Display message when image is not available
                            echo "Image not Available.";
                        } else {
                            // Display the image when it is available
                            echo '<img src="' . SITEURL . 'images/category/' . $image_name . '" width="200" height="300">';
                        }
                        ?>



                        <h5 class="gallary_btn"><?php echo $title; ?></h5>
                    </div>
                </a>
        <?php
            }
        } else {
            //category not available
            echo "<div class='error'>category not available</div>";
        }
        ?>

    </div>
    

</div>


<!-- end category -->


    <!--Menu-->

   <!--food-->

<div class="menu" id="Menu">
    <h1>Our<span>foods</span></h1>
    <div class="menu_box">

        <?php
        // Getting Foods from the database that are active and featured

        // SQL query
        $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 12";

        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        // Count rows
        $count2 = mysqli_num_rows($res2);

        // Check whether food is available or not
        if ($count2 > 0) {
            // Food available
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>

                <div class="menu_card">
                    <form method="post" action="addToCart.php?action=add&id=<?php echo $id; ?>">
                        <div class="menu_image">


                            <?php
                            // Check if the image is available or not
                            if ($image_name == "") {
                                // Image not available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                // Image available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="food image">
                            <?php
                            }
                            ?>
                        </div>



                        <div class="small_card">

                            <i class="fa-solid fa-heart"></i>
                        </div>

                        <div class="menu_info">
                            <h2><?php echo $title; ?></h2>
                            <p>
                                <?php echo $description; ?>
                            </p>
                            <h3><?php echo $price; ?></h3>
                            <!-- star -->

                            <!-- <div class="ratting">
                                4.3
                                <img class="_1wB99o" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMyIgaGVpZ2h0PSIxMiI+PHBhdGggZmlsbD0iI0ZGRiIgZD0iTTYuNSA5LjQzOWwtMy42NzQgMi4yMy45NC00LjI2LTMuMjEtMi44ODMgNC4yNTQtLjQwNEw2LjUuMTEybDEuNjkgNC4wMSA0LjI1NC40MDQtMy4yMSAyLjg4Mi45NCA0LjI2eiIvPjwvc3ZnPg==">

                            </div> -->

                            <!-- end star -->
                            <div class="menu_icon">

                                <!-- <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i> -->

                            </div>
                            <table>
                                <tr>

                                    <td><input type="number" id="quantity" style="width: 54px; margin: 0px 0px 0px 22px;background-color: antiquewhite;" name="hidden_Quantity" value="1">
                                        <input type="hidden" name="hidden_image" value="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>">
                                        <input type="hidden" name="hidden_name" value="<?php echo $title; ?>">
                                        <input type="hidden" name="hidden_price" value="<?php echo $price; ?>">
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
            echo "<div class='error'>Food not available</div>";
        }
        ?>



    </div>
    <br>
    

</div>




    <!--Review-->

    <div class="review" id="Review">
        <h1>Customer<span>Review</span></h1>

        <div class="review_box">
            <div class="review_card">

                <div class="review_profile">
                    <img src="image/review_1.png">
                </div>

                <div class="review_text">
                    <h2 class="name">Priya</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                    I recently had the pleasure of experiencing the outstanding services provided by this company, and I must say, I am thoroughly impressed. From the moment I engaged with their team, I felt valued and heard. Their attention to detail and commitment to quality truly sets them apart. The end results exceeded my expectations, and I couldn't be happier with the outcome.
                    </p>

                </div>

            </div>

            <div class="review_card">

                <div class="review_profile">
                    <img src="image/review_2.png">
                </div>

                <div class="review_text">
                    <h2 class="name">Arjun</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                    My dining experience at this restaurant was truly exceptional. The food was a delightful symphony of flavors, and every dish was a culinary masterpiece. The presentation was as impressive as the taste, and the attention to detail was evident in every bite. The staff was attentive and knowledgeable, enhancing the overall experience.
                    </p>

                </div>

            </div>

            <div class="review_card">

                <div class="review_profile">
                    <img src="image/review_3.png">
                </div>

                <div class="review_text">
                    <h2 class="name">Aaradhya</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                    I had the pleasure of dining at this restaurant, and it was a delightful culinary experience. The food was not only incredibly delicious but also beautifully presented, showing the chef's dedication to their craft. The menu offered a variety of enticing options, and the flavors were exquisite. The service was impeccable, with a knowledgeable and friendly staff.
                    </p>

                </div>

            </div>

            <div class="review_card">

                <div class="review_profile">
                    <img src="image/review_4.png">
                </div>

                <div class="review_text">
                    <h2 class="name">Aarav</h2>

                    <div class="review_icon">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>

                    <div class="review_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>

                    <p>
                    My recent visit to this restaurant was truly exceptional. From the moment I walked in, the welcoming atmosphere set the tone for a delightful dining experience. The service was attentive, and the menu offered a diverse range of options to cater to various tastes. The food was not only delicious but also beautifully presented, showcasing the chef's expertise. I left with a satisfied palate and a strong desire to return soon.
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!--Order-->

    <!-- <div class="order" id="Order">
        <h1><span>Order</span>Now</h1>

        <div class="order_main">

            <div class="order_image">
                <img src="image/order_image.png">
            </div>

            <form action="#">

                <div class="input">
                    <p>Name</p>
                    <input type="text" placeholder="you name">
                </div>

                <div class="input">
                    <p>Email</p>
                    <input type="email" placeholder="you email">
                </div>

                <div class="input">
                    <p>Number</p>
                    <input placeholder="you number">
                </div>

                <div class="input">
                    <p>How Much</p>
                    <input type="number" placeholder="how many order">
                </div>

                <div class="input">
                    <p>You Order</p>
                    <input placeholder="food name">
                </div>

                <div class="input">
                    <p>Address</p>
                    <input placeholder="you Address">
                </div>

                <a href="#" class="order_btn">Order Now</a>

            </form>

        </div>

    </div> -->



    <!--Team-->

    <!-- <div class="team">
        <h1>Our<span>Team</span></h1>

        <div class="team_box">
            <div class="profile">
                <img src="image/chef1.png">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="image/chef2.png">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="image/chef3.jpg">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="image/chef4.jpg">

                <div class="info">
                    <h2 class="name">Chef</h2>
                    <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

        </div>

    </div> -->
    <br> <br><br>

    <?php include('partials-front/footer.php'); ?>