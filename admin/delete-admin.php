<?php
include ("../config/constants.php");

//get id to be deleted 
$id= $_GET['id'];

//sql query for deletion
$sql = "DELETE FROM admin WHERE id=$id";

//executing the query
$res = mysqli_query($conn, $sql);

if($res){
   //creating session variable to display message
   $_SESSION['del'] = '<div class="success">ADMIN DELETED SELECTED</div>';
   //redirecting to admin page
   header("location:".SITEURL."admin/admin.php");
}else{
    $_SESSION['del'] = '<div class="error">ADMIN NOT DELETED SELECTED</div>';
    header("location:".SITEURL."admin/admin.php");
}

?>