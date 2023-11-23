<?php
include('partilas/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>change password</h1>
        <br> <br>

        <?php

        $id = $_GET['id'];
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>current password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>

                </tr>

                <tr>
                    <td>new password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password" value="">
                    </td>
                </tr>

                <tr>
                    <td>confirm password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="change password" class="btn-danger add-admin">
                    </td>
                </tr>
            </table>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</div>

<?php
// Check whether the submit Button is clicked on or not
if (isset($_POST["submit"])) {
    // Get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']); // Corrected $_POST here
    $new_password = md5($_POST['new_password']); // Corrected $_POST here
    $confirm_password = md5($_POST['confirm_password']); // Corrected $_POST here
    //2. Check whether the user with the current id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //Execute the QUERY
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        // Check whether a row with the provided id and current password was found
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // User exists and the current password is correct, proceed to change the password
            if ($new_password == $confirm_password) {
                // Update the password in the database
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                // Execute the query and check if it executed successfully
                if ($res2 == true) {
                    // Display success message
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                } else {
                    // Display error message
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                } 
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Passwords do not match</div>";
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // User does not exist with the provided id and current password
            $_SESSION['user-not-found'] = "<div class='error'>User not found or current password is incorrect</div>";
            header("location:" . SITEURL . 'admin/manage-admin.php');
        }
    }
}


?>




<?php
include('partilas/footer.php');
?>



<!-- $sql_update = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                $res_update = mysqli_query($conn, $sql_update);

                if ($res_update) {
                    $_SESSION['user-not-found'] = "<div class='success'>Password changed successfully</div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
               
            
            } -->