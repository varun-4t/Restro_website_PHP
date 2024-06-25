<?php 
include("../config/constants.php");


if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // start delete process
    // get id and img name
    $id = $_GET['id'];
    $img = $_GET['image_name'];

    // check & remove the img only if available
    if($img!="")
    {
            //img is available
            // get img path
            $path = "../images/food/".$img;

            //remove img file from the folder
            $remove = unlink($path);

            if($remove==false){
                    // failed to remove
                    $_SESSION['upload'] = "<div class='error'>Failed to Remove Image</div>";
                    // redirect to food.php
                    header("location:".SITEURL."admin/food.php");
                    //stop the process
                    die();
            }

        // delete food from database
        $sql = "DELETE FROM food WHERE id=$id";

        // execute query
        $res = mysqli_query($conn, $sql);

        // check whether query executed or not 
        if($res==true){
            // food deleted 
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header("location:".SITEURL."admin/food.php");
        }else{
            // failed to delete
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header("location:".SITEURL."admin/food.php");
        }

    }else{
        // redirect to food.php
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header("location:".SITEURL."admin/food.php");
    }
}
?>