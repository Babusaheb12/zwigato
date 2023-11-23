<?php include('config\constants.php'); 
include('font-logincheck.php');
?>


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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <section id="Home">
        <nav>
            <div class="logo">
                <img src="images\logo.jpg">
            </div>

            <ul>
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                <li><a href="<?php echo SITEURL; ?>foods.php">Food</a></li>
                <li><a href="<?php echo SITEURL; ?>restaurant.php">Restaurant</a></li>
<!--  -->
                <!-- <li><a href="#Review">Review</a></li>
                <li><a href="#Order">Order</a></li>  -->
            </ul>


            <div class="sign-in-up icon">
             <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
             <a href="wishlist.php?id=<?php echo $row['id']; ?> ?>wishlist.php"><i class="fa-solid fa-heart"></i></a>


                <!-- link card -->
                <?php
                $count=0;
                if(isset($_SESSION["shopping_cart"])){
                    $count=count(($_SESSION["shopping_cart"]));
                }
                ?>
                <a href="addToCart.php">
                <!-- <i class="fa-solid fa-cart-shopping">0</i> -->
                <i class="fa fa-shopping-cart"> <?php echo $count; ?></i>
                </a>
                <!-- end mykart -->

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