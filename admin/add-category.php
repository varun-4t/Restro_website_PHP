<?php include('partials/header.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }

            if(isset($_SESSION['upload-fail'])){
                echo $_SESSION['upload-fail'];
                unset($_SESSION['upload-fail']);
            }
        ?>
        <br><br>

        <form method="POST" enctype="multipart/form-data"> 
            <table class="tb-30"> 
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder='Enter Category Title'></td>
                </tr>
                
                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name='img' >
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value='Yes'>Yes
                        <input type="radio" name="featured" value='No'>No
                    </td>
                </tr>   
                
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value='Yes'>Yes
                        <input type="radio" name="active" value='No'>No
                    </td>
                </tr>   
                                  
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Category"  name="add_category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php 
//check whether submit button is clicked or not
if(isset($_POST['add_category'])){
    //get the value form the form 
    $title = $_POST['title'];

    //getting value of featured for input type = radio
    if(isset($_POST['featured'])){
        //get the value 
         $featured = $_POST['featured'];
    
    }else{
    
        //set default value
        $featured = "No";
    }

    //getting value of active for input type = radio
    if(isset($_POST['active'])){
        //get the value 
         $active = $_POST['active'];
    
    }else{
        //set default value
        $active = "No";
    }
 
    //check if img is selected or not and set value for img name accordingly

    // print_r($_FILES['img']); //just printing the array to see value

    if(isset($_FILES['img']['name'])) //$_FILES[ name in the input tag ][ 'name' key in the $_FILES array ] check by print_r
    {
            //upload the img
            
            //to upload the img we need - image name, source path and destination path        
            $img = $_FILES['img']['name'];
    
            // upload the image only if image is available
            if($img != "")
            {

            $source_path = $_FILES['img']['tmp_name'];
            
            $desti_path = "../images/category/".$img;

            //finally upload the img
            $upload = move_uploaded_file($source_path, $desti_path);

            //check whether the img is uploaded or not
            //if img is not uploaded then we will stop the process and redirect it with error msg
            if($upload==false){
                //set session
                $_SESSION['upload-fail'] = "<div class='error'>Failed to upload image</div>";
                header("location:".SITEURL."admin/add-category.php");
                //stop the process
                die();
            }
        }
        }else{
            //don't upload the img and set the $img as empty
            $img = "";
        }
    

    //create sql query to insert category into database
    $sql = "INSERT INTO category SET Title='$title', Featured='$featured', img_name='$img',  Active='$active' ";

    //execute the query & save in db
    $res = mysqli_query($conn,$sql);

    //check if query executed or not
    if($res){
        //query executed and category added
        $_SESSION['add-category'] = "<div class='success'>Category Addedd Successfully</div>";

        //redirect to category page
        header("location:".SITEURL."admin/category.php");
    }else{
        //failed to add category
        $_SESSION['add-category'] = "<div class='error'>Failed to add Category</div>";

        //redirect to category page
        header("location:".SITEURL."admin/add-category.php");
    }
}
?>

<?php include('partials/footer.php');?>