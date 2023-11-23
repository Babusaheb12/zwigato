<?php
include('config\constants.php');


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
{
    require 'php_mailer\PHPMailer.php';
    require 'php_mailer\SMTP.php';
    require 'php_mailer\Exception.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '20010001014@gateway.edu.in';                     //SMTP username
        $mail->Password   = '6204592045';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('20010001014@gateway.edu.in', 'Zwigato');
        $mail->addAddress($email);     //Add a recipient



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification from Zwigato food order';
        $mail->Body    = "thanks for registation!
        click the link and verify the email address
        <a href='http://localhost/Zwigato/verify.php?email=$email&v_code=$v_code'>VERIFY</a>
        
        ";


        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_SESSION['not-login-massage'])){
    echo$_SESSION['not-login-massage'];
    unset($_SESSION['not-login-massage']);
}



#login
if (isset($_POST['login'])) {
    $email_phone_number = $_POST['email_phone_number'];

    // Query for finding the user
    $query = "SELECT * FROM `register_user` WHERE email = '$email_phone_number' OR phone_number = '$email_phone_number'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            if ($result_fetch['is_verified'] == 1) {
                // User is verified, set the session and redirect to index.php
                $_SESSION['logged_in'] = true;
                $_SESSION['name'] = $result_fetch['name'];

                //redirect to index page.
                header("location:" . SITEURL . 'index.php');
                // echo"
                // <script>
                // alert('welcome to the Zwigato.');
                // window.location.href = 'index.php';
                // </script> ";
                // header("location: index.php");

            } else {
                // User is not verified, show an alert and redirect to index.php

                $_SESSION['login'] = "<div class='error'>Username and password did not match</div>";

                // redirect to the home page
                header("location:" . SITEURL . 'contact.php');

                // echo "
                // <script>
                // alert('Email is not verified. Please check your email for verification.');
                // window.location.href = 'index.php';
                // </script>
                // ";
               
            }
        } else {
            $_SESSION['login'] = "<div class='error'>Username and password did not match</div>";

            // redirect to the home page
            header("location:" . SITEURL . 'contact.php');
            
            // No matching user found, redirect to index.php
            // echo "
            // <script>
            // alert('Email is not verified. Please check your email for verification.');
            // window.location.href = 'index.php';
            // </script>
            // ";
        }
    } else {
        // Error in query execution, redirect to index.php
        header("location: index.php");
    }
}




#for registation
if (isset($_POST['register'])) {
    $user_exist_Query = "SELECT * FROM `register_user` WHERE `email`='$_POST[email]' OR `phone_number`='$_POST[phone_number]'";

    $result = mysqli_query($conn, $user_exist_Query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            #if any user has already taken username or email
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['phone_number'] == $_POST['phone_number']) {
                #error for phone number already register
                echo "
                <script>
                alert('{$result_fetch['phone_number']} - phone number already exists');
                window.location.href = 'index.php';
                </script>
            ";
            } else {
                #error for email alredy register
                echo "
                <script>
                alert('{$result_fetch['email']} - email already exists');
                window.location.href = 'index.php';
                </script>
            ";
            }
        } else {  #it will be execute if no one has taken phone number or email before

            $v_code = bin2hex(random_bytes(16));

            $query = " INSERT INTO `register_user`(`id`, `name`, `address`, `phone_number`, `email`, `verification_code`, `is_verified`) VALUES ('[value-1]','$_POST[Name]', '$_POST[address]', '$_POST[phone_number]', '$_POST[email]', '$v_code','0')";



            if (mysqli_query($conn, $query) && sendMail($_POST['email'], $v_code)) {
                echo "
            <script>
            alert('Registration successful');
            window.location.href='index.php';
            </script>
            ";
            } else {
                #if data cannot be inserted
                echo "
            <script>
            alert('Server Down');
            window.location.href='index.php';
            </script>
            ";
            }
        }
    } else {
        echo "
        <script>
        alert('cannot run query');
        window.location.href='index.php';
        </script>
        ";
    }
}
