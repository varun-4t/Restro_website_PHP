<?php
 
//Authorization - Access control
//check whether the user is logged in or not
if(!isset($_SESSION['user'])) //if user session is not set
{ 
    $_SESSION['no-login-msg'] = "<div class='error text-center'> Please Login to Access Panel </div>";
    header("location:".SITEURL."admin/login.php");
}
?>