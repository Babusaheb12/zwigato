<?php include('../config\constants.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Zwigato</title>
    <link rel="stylesheet" href="../css\admin.css">
</head>

<body>
    <div class="banner">
        <div class="login">
            <h1> admin login</h1>
            <br>

            <?php
                if(isset($_SESSION['login.php']))
                {
                    echo $_SESSION['login.php'];
                    unset ($_SESSION ['login.php']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                   echo $_SESSION['no-login-message'];
                   unset($_SESSION['no-login-message']);

                }
                ?>
                <br><br>
            <!-- Login form start here -->
            <form action="" method="post">
                <table class="tbl">
                    <tr>
               <td> <h3>username: </h3></td>
               <td>
                <input type="text" name="username" class="xyz" placeholder="enter username">
                </td>
                </tr>
                <!-- <br><br> -->
                <tr>
                <td><h3>password: </h3></td>
                <td>
                <input type="password" name="password" class="xyz" placeholder="enter password">
                </td>
                </tr>

                <tr>
                    <td>
                <button type="submit" name="submit" value="login"  class="button content"><span class="cover"></span>login</button>
                </td>
                </tr>
                </table>
            </form>
            <!-- login form end -->
            <p>created by: <a href="" class="abc">babu saheb, ujjawal kumar roy & akash</a></p>
        </div>

    </div>
</body>
</div>

</div>
</body>

<?php
if(isset($_POST['submit'])) {
    // Prepare for login
    // 1. Get the data from the login page
    $username = $_POST['username'];
    $password =md5($_POST['password']);

    // 2. Check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not.
    $count = mysqli_num_rows($res);

    if($count==1) {
        // User available and login success 
        $_SESSION['login'] = "<div class='success'>Login successful.</div>";
        $_SESSION['user']=$username;  //to check whether the user is logged in or not and unset it

        // Redirect to Home page
        header("location:" . SITEURL . 'admin/');
         // Ensure no further code execution after the redirect
    } else {
        // User not available
        $_SESSION['login'] = "<div class='error'>Username and password did not match</div>";

        // Redirect to Home page
        header("location:" . SITEURL . 'admin/login.php');
         // Ensure no further code execution after the redirect
    }
}


?>

