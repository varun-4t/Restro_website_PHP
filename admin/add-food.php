<?php include ('partials/header.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>    
        <br>
        <form method="POST" enctype="multipart/form-data"> 
            <table class="tb-30"> 
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder='Enter Food Title'></td>
                </tr>
                
                <tr>
                    <td>About :</td>
                    <td><textarea name="about" cols="35" rows="5" placeholder="About Food"></textarea></td>
                </tr>
                
                <tr>
                    <td>Price :</td>
                    <td><input type="number" name="price" placeholder='Enter Food Price'></td>
                </tr>
                
                <tr>
                    <td>Select Image :</td>
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
                                    $id = $row['ID'];
                                    $title = $row['Title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>                                        
                                    
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
                        <input type="submit" value="Add Food"  name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            // check whether button is clicked or not
            if(isset($_POST['submit'])){
                // add the food in database
                
                // 1. get data from Form
                $title = $_POST["title"];
                $about = $_POST['about'];
                $price= $_POST['price'];
                $category=$_POST['category'];
                
                // check whether radio button for Featured and Active are check or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No"; //setting default value
                }
                
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No"; //setting default value
                }

                // 2. upload the img if selected

                    // check whether the select img button is clicked or not and upload the img only if selected
                    if(isset($_FILES['img']['name']))
                    {
                        // get the details of th selected img 
                        $img = $_FILES['img']['name'];
                        
                        // check whether img is selected or not and upload the img only if selected
                        if($img!=""){
                            // img is selected
                            // 1. rename the img
                                // get extension of selected img (jpg,png,gif)
                                $ext = end(explode(".",$img));
                                // create a new name for img
                                $img = "newfood-".rand(0000,9999).".".$ext; 

                            // 2. upload the img
                            // get the source path and destination path (source path - current location of the img)
                            $src = $_FILES['img']['tmp_name'];

                            // destination path
                            $dest = "../images/food/".$img;

                            // upload img
                            $upload = move_uploaded_file($src,$dest); //function to upload file in folder
 
                            // check whether img uploaded or not
                            if($upload==false)
                            {
                                //failed to upload the img
                                // redirect to add-food.php with error msg and stop processing
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                header('location:'.SITEURL."admin/add-food.php"); 
                                exit();
                            }
                        }
                    }else{
                        $img = ""; //setting default value as blank if img is not selected
                    }


                // 3. insert into database 

                    //create sql query
                    // for numerical value we don't need to pass value inside quotes '' but for string values we have to pass it inside
                    $sql2 = "INSERT INTO food SET Title='$title', About='$about', Price=$price, image_name='$img', Category_ID=$category, Featured='$featured', Active='$active'";
                    
                    // execute query
                    $res2 = mysqli_query($conn, $sql2);
                    // check whether record inserted or not
                // 4. redirect with msg to food.php
                    if($res2==true){
                        // successfully inserted
                        $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                        header('location:'.SITEURL."admin/food.php");
                    }else{
                        // failed to insert
                        $_SESSION['add']="<div class='error'>Failed to add food</div>";
                        header('location:'.SITEURL."admin/food.php");
                    }
            }
        ?>                    

    </div>
</div>
<?php include ('partials/footer.php')?>