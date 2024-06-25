    <?php include("partials/header.php")?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>

            <!-- getting the values -->
            <?php 
                if(isset($_GET['id'])){
                    //get the id and all other details
                    $id = $_GET['id'];

                    //creating sql query to get all other details
                    $sql = "SELECT * FROM category WHERE id=$id";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the rows
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        //get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['Title'];
                        $current = $row['img_name'];
                        $featured = $row['Featured'];
                        $active = $row['Active'];
                    }else{
                    //redirect to category.php
                    $_SESSION['no-category']="<div class='error'>Category not found.</div>";
                    header("location:".SITEURL."admin/category.php"); 
                    }

                }else{
                    //redirect to category.php
                    header("location:".SITEURL."admin/category.php");
                }
            ?>


            <form method="POST" enctype="multipart/form-data"> 
                <table class="tb-30"> 
                    <tr>
                        <td>Title :</td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"></td>
                    </tr>
                    
                    <tr>
                        <td>Current Image :</td>
                        <td>
                            <?php
                                if($current!=""){
                                    //display the img
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current;?>" width="150px;">
                                    <?php
                                }else{
                                    //display message
                                    echo "<div class='error'>Image not added.</div>";
                                } 
                            ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>New Image :</td>
                        <td>
                            <input type="file" name='image'>
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
                        <input type="hidden" name="current" value="<?php echo $current; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <td><input name="submit" type="submit" value=" Update Category " class="btn-secondary"></td>
                    </tr>
                </table>       
            </form>                      

            <?php
                // check if button is clicked
                if(isset($_POST['submit']))
                {
                    // Get values from our form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current = $_POST['current'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];
                    
                    //updating new img if selected
                    // check whether the img is selected or not
                    if(isset($_FILES['image']['name'])){
                        //get img details
                        $img_name=$_FILES["image"]["name"];

                        //check if img available or not
                        if($img_name !=''){ 
                            //img available
                            // upload the image
                            //auto rename the img
                            //get the extension of img (jpg, png, gif, etc) 
                            $ext = end(explode(".", $img_name));
                            //rename the img 
                            $img_name = 'Food_Category_'.rand(000,999).".".$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$img_name;

                            //finally upload the img
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check whether img is uploaded or not
                            //and if img is not uploaded then we stop process and redirect with msg
                            if($upload==false){
                                //set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                header("location:".SITEURL."admin/category.php");
                                //stop process
                                die();
                            }

                            // remove the current img if available
                            if($current != ""){
                                $remove_path = "../images/category/".$current;
                                $remove = unlink($remove_path);
                                //check whether the file removed or not
                                if($remove==false){
                                    //failed to remove img
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove Image.</div>";
                                    header("location:".SITEURL."admin/category.php");
                                    die();
                                }
                            }

                        }else{
                            $img_name  = $current;    
                        }
                    }else{
                        $img_name  = $current;
                    }

                    //update the database
                    $sql2 = "UPDATE category SET Title='$title', img_name='$img_name', Featured='$featured', Active='$active' WHERE ID='$id' ";

                    //execute query
                    $res2 = mysqli_query($conn, $sql2);

                    //redirect to category with message
                    //check whether executed or not
                    if($res2){
                        //category updated
                        $_SESSION['update'] = "<div class='success'>Successfully Updated Category.</div>";
                        header("location:".SITEURL."admin/category.php");
                    }else{
                        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                        header("location:".SITEURL."admin/category.php");
                    }

                }

            ?>

        </div>
    </div>

    <?php include("partials/footer.php")?>