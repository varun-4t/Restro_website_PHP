<!-- deleting category as well as img for the img folder if available -->
<?php 
include("../config/constants.php");

//check whether id and img_name value are set or not
if(isset($_GET['id']) && isset($_GET['image_name'])){
    
    //get value & delete
    $id = $_GET['id'];
    $img_name = $_GET['image_name'];

    //remove img if available
    if($img_name != "")
    {
        
        //img available
        $path = "../images/category/".$img_name;
        //remove the img
        $remove = unlink($path); //remove variable will have boolean value
        
        //if failed to remove img then add an error msg and stop the process
        if($remove == false){
    
            //set the session msg , then redirect to category page, then stop process
            $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image</div>";
            header('location:'.SITEURL.'admin/category.php');
            die();
        }
    
    }

    //sql query to delete data from categories table where id matches with given id
    $sql = "DELETE FROM category WHERE ID=$id";

    //execute the query 
    $res = mysqli_query($conn, $sql);

    //check whether data is deleted from database or not 
    if($res){
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header("location:".SITEURL."admin/category.php");
    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete</div>";
        header("location:".SITEURL."admin/category.php");
    }

}else{
    //redirect to category page
    header("location:".SITEURL."admin/category.php");
}

?>