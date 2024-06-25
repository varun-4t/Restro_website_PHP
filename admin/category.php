<?php include('partials/header.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Category</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['no-category'])){
                echo $_SESSION['no-category'];
                unset($_SESSION['no-category']);
            }
            
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
        <br><br> 

               <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br><br>
               <table class="table">
               
               <tr>
                    <th>SrNo</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                    <?php
                    //creating serial number variable 
                    $sr = 1;
                    
                    //Query to get all categories from database
                    $sql = "SELECT * FROM category";

                    //execute query
                    $res = mysqli_query($conn,$sql);

                    //count number of rows
                    $count = mysqli_num_rows($res);
                    
                    //check whether we have data in database or not
                    if($count>0){
                        //we have data 
                        //get data and display it
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['ID'];
                            $title = $rows['Title'];
                            $img_name = $rows['img_name'];
                            $feature = $rows['Featured'];
                            $active = $rows['Active'];

                            ?>
                                    <tr>
                                        <td><?php echo $sr++;?></td>
                                        <td><?php echo $title?></td>

                                        <td>
                                            <!-- check whether img name is available or not -->
                                            <?php 
                                                  if($img_name!=""){
                                                    //display the img
                                                    ?>
                                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $img_name;?>" width='150px'>
                                                    <?php
                                                  }else{
                                                    //display the message
                                                    echo "<div class='error'>Image not available</div>";
                                                  }   
                                            ?>
                                        </td>
                                        
                                        <td><?php echo $feature?></td>
                                        <td><?php echo $active?></td>
                                        <td>
                                        <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
<!--passing id and img_name through url --><a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $img_name;?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>

                            <?php
                        }
                    }else{
                        //we do not have data
                        //we'll display the message 
                        ?>

                            <tr>
                                <td colspan="6">
                                    <div class="error">No Category Added.</div>
                                </td>
                            </tr>
                    <?php
                    }
                    ?>
                
               

                </table>
    </div>
</div>

<?php include('partials/footer.php');?>