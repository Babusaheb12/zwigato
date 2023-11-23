<?php
include('partilas/menu.php');
?>

<div class="main-content">
    <div class="wrapper">

    <h1>update admin</h1>

    <br><br>
    <?php
    
    // 1. Get the id of the selected Admin
    $id = $_GET['id'];
    
    // 2. Create SQL QUERY to get the details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    
    // Execute the query 
    $res = mysqli_query($conn, $sql);
    
    // Check whether the query executed successfully
    if ($res == true) {
        // Check whether the data is available or not
        $count = mysqli_num_rows($res);
    
        // Check whether we have admin data or not
        if ($count == 1) {
            // Get the details
            $row = mysqli_fetch_assoc($res);
            $full_name = $row['full_name'];
            $username = $row['username'];
            
            // ... (fetch other columns as needed)
        } else {
            // Redirect to the manage admin page
            header("location:" . SITEURL . 'admin/manage-admin.php');
        }
    } else {
         // Handle the case where the query didn't execute successfully
         echo "Error: " . mysqli_error($conn);
    }
    ?>
    

    <form action="" method="post">
    <table class="tbl-30">
        <tr>
            <td>full name:</td>
            <td>
                <input type="text" name="full_name" value="<?php echo $full_name ?>">
            </td>
        </tr>
        <tr>
            <td>username:</td>
            <td>
                <input type="text" name="username" value="<?php echo $username ?>">
            </td>
        </tr>
        <!--  -->
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="update admin" class="btn-secondary add-admin ">
            </td>
        </tr>
    </table>

    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</div>

<?php
// Check whether the submit button was clicked
if (isset($_POST['submit'])) {
    // Get all the values to update
    $id = $_POST['id'];
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];

    // Create an SQL Query to update admin
    $sql = "UPDATE tbl_admin SET 
            full_name='$full_name', 
            username='$username' 
            WHERE id=$id";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if ($res == true) {
        // Query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
        //Redirect to manage page
        header("location:".SITEURL.'admin/manage-admin.php');
    } else {
        // Failed to update admin
        $_SESSION['update'] = "<div class='error'>failed to delete admin</div>";
        //Redirect to manage page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
}
?>





<?php
include('partilas/footer.php');
?>