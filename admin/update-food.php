<?php include("partials/header.php");?>

<?php 
if(isset($_GET['id']))
{
    //get all the details
    $id = $_GET['id'];
    // sql query to get the selected food details
    $sql2 = "SELECT * FROM food WHERE id=$id";
    // execute query
    $res2 = mysqli_query($conn, $sql2);

    // get the value 
    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['Title'];
    $about = $row2['About'];
    $price = $row2['Price'];
    $current_image = $row2['image_name'];
    $current_catergory = $row2['Category_ID'];
    $featured = $row2['Featured'];
    $active = $row2['Active'];
}
else{
    // redirect to food.php
    header("location:".SITEURL."admin/food.php");
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form method="POST" enctype="multipart/form-data"> 
            <table class="tb-30"> 
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                </tr>
                
                <tr>
                    <td>About :</td>
                    <td><textarea name="about" cols="35" rows="5" ><?php echo $about;?></textarea></td>
                </tr>
                
                <tr>
                    <td>Price :</td>
                    <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                </tr>
                
                <tr>
                    <td>Current Image :</td>
                    <td>
                        <!-- checking if img available or not -->
                        <?php 
                            if($current_image == "" ){
                                // img not available
                                echo "<div class='error'>Image not Available.</div>";
                            }else{
                                // img available
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px;">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image :</td>
                    <td><input type="file" name="img"></td>
                </tr>
                
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                            // php code to display categories from database
                            // sql query to get all active categories from database
                            $sql = "SELECT * FROM category WHERE active='Yes' ";

                            // execute the query
                            $res = mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            if($count>0){
                                // we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    // get the details of category
                                    $category_id = $row['ID'];
                                    $category_title = $row['Title'];
                              ?>

                                    <option <?php if($current_catergory==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>                                        
                                    
                                    <?php
                                }
                            }else{
                                // we do not have categories
                                ?>
                                <option value="0">No Categories Found</option>
                                <?php 
                            }
                            // display on dropdown 
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value='Yes'>Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value='No'>No
                    </td>
                </tr>   
                
                <tr>
                    <td>Active :</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value='Yes'>Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value='No'>No
                    </td>
                </tr>   
                                  
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" value="Add Food"  name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php 
            // check if button is clicked or not
            if(isset($_POST['submit'])){
                // get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $about = $_POST['about']; 
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // upload the img if selected 

                    // check if upload button is clicked or not 
                    if(isset($_FILES['img']['name'])){
                        // upload button clicked
                        $image_name = $_FILES['img']['name']; //new img name

                            // check whether the file is available or not
                            if($image_name!=""){
                                // image available
                                // A. uploading new image

                                    // rename the image
                                    $exploded = explode(".", $image_name);
                                    $ext = end($exploded); //this gets the extension of the image
                                    $image_name = "newfood-".rand(0000,9999).".".$ext ;
                                // to upload the img get the source path and destination path
                                $src = $_FILES['img']["tmp_name"];
                                $dest = "../images/food/".$image_name;
                        
                                // upload img
                                $upload = move_uploaded_file($src,$dest);

                                // check whether img is uploaded or not 
                                if($upload==false){
                                    $_SESSION['upload']="<div class='error'>Failed to upload New Image.</div>";
                                    header("location:".SITEURL."admin/food.php");
                                    // stop the process
                                    die();
                                }
                        
                            // remove the img if new img is uploaded & current img exists
                            // B. remove current image if available
                            if($current_image!=""){
                                // current img available
                                // remove the img 
                                $remove_path = "../images/food/".$current_image; 

                                $remove = unlink($remove_path);
                                // check whether image is removed or not
                                if($remove==false){
                                    // failed to remove current image
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current Image</div>";
                                    header("location:".SITEURL."admin/food.php");
                                    // stop the process
                                    die(); 
                                }  
                            }
                        }else{
                            $image_name = $current_image; //default image name when image is not selected
                        }
                    }
                    else{
                        $image_name = $current_image; //default image name when button is not clicked
                    }

                // update the data in database
                $sql3 = "UPDATE food SET
                    Title = '$title',
                    About = '$about',
                    Price = '$price',
                    image_name = '$image_name',
                    Category_ID = '$category',
                    Featured = '$featured',   
                    Active = '$active'
                    WHERE ID=$id  
                ";
                
                // execute query
                $res3 = mysqli_query($conn,$sql3);
                // check whether query executed or not
                if($res3)
                {
                    // query executed 
                    $_SESSION['update']= "<div class='success'>Data Updated Successfully</div>";
                    header("location:".SITEURL."admin/food.php");
                    // print_r($_FILES);
                }else{
                    // failed to update food
                    $_SESSION['update']= "<div class='error'>Failed to Update</div>";
                    header("location:".SITEURL."admin/food.php");
                }
            }
        
        ?>

    </div>
</div> 

<?php include("partials/footer.php");?>