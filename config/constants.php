<?php 

//starting the session
session_start();

//defining constants
define('SITEURL','http://localhost/project/') ; //constants are always defined in capital letters




//mysqli_query(localhost, username, password) by default password is blank
//die is the alias to exit(), if connection is failed, die() will execute
$conn = mysqli_connect('localhost','root') or die("Connection failed: " .mysqli_error());    //to establish connection with mysql     
$db_select = mysqli_select_db($conn, "food_order") or die("Connection failed: " .mysqli_error()); //to select database
?>

    