<?php include('partilas/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br> <br>
        <?php
        if(isset($_SESSION['add']))  //checking whether the session is started or not 
        {
            echo ($_SESSION['add']); //Display the session message if set
            unset($_SESSION['add']);  //Remove session message
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>full name: </td>
                    <td><input type="text" name="full_name" placeholder="enter you name"></td>
                </tr>

                <tr>
                    <td>username:</td>
                    <td><input type="text" name="username" placeholder="enter username"></td>
                </tr>

                <tr>
                    <td>password:</td>
                    <td><input type="password" name="password" placeholder="enter password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-danger add-admin">
                    </td>
                </tr>
            </table>
        </form>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</div>

<?php
include('partilas/footer.php');
?>

<?php
//process the value from and save it in adatabase

//check whether the submit button click or out

if (isset($_POST['submit'])) {
    //Button clicked
    //echo clicked

    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);  //password encryption with MD5.

    //2.sql query to save the data into a database

    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username' ,
    password='$password'";

  //Executing query and saving data into database.

$res=mysqli_query($conn, $sql) or die(mysqli_error());

//4.check whether the (Query in executed ) data is inserted or not and display massege

if($res==true)
{
    //data inserted
    //echo "Data inserted";
    //create a session variable to display message.
    $_SESSION['add']="<div class='successA'>Admin added seccessfully</div>";
    
    //Redirect page to manage admin

    header("location:".SITEURL.'admin/manage-admin.php');


}
else 
{
    //failed to insert data
    // echo "failed to insert data";

     //create a session variable to display message.
     $_SESSION['add']="FAILED to add admin";
    
     //Redirect page to add admin
 
     header("location:".SITEURL.'admin/manage-admin.php');
}
}
?>