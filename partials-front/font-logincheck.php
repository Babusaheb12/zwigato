<?php
//Authorization - Access control 
//check whether the user is login or not
if(!isset($_SESSION['name']))  // if user session is not login 
{
$_SESSION['not-login-massage']="echo' 
<script>
            alert('please login acess login pannel.');
                
                </script>
'";
//Redirect to logi here
header("location:" . SITEURL . 'contact.php');
}

?>