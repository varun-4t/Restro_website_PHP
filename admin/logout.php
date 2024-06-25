<?php 
    //include constants.php for url 
    include("../config/constants.php");

    //Display session 
    session_destroy(); //unsets $_SESSION['user'] ;
    //Redirect to login page
    header("location:".SITEURL."admin/login.php");
?>