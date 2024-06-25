<?php include("partials/header.php");?>

<!-- Main Section -->
        <div class="main-content">
            <div class="wrapper">
               <h2>Manage Admin</h2>
               <br>
               <?php 
               if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
               } ?>
               <br>
               <?php
               if(isset($_SESSION['del'])){
                echo $_SESSION['del'];
                unset($_SESSION['del']);
               } 
               
               if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
               } 
               
               if(isset($_SESSION['pass_update'])){
                echo $_SESSION['pass_update'];
                unset($_SESSION['pass_update']);
               } 
               
               if(isset($_SESSION['no_user'])){
                echo $_SESSION['no_user'];
                unset($_SESSION['no_user']);
               } 
               
               if(isset($_SESSION['no_match'])){
                echo $_SESSION['no_match'];
                unset($_SESSION['no_match']);
               } 
               
               if(isset($_SESSION['not_update'])){
                echo $_SESSION['not_update'];
                unset($_SESSION['not_update']);
               } 
               ?>
               
               <br>
               <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br>
               <table class="table">
               
               <tr>
                    <th>SrNo</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                //creating serial number variable
                $sr = 1;

                $sql = "SELECT * FROM admin";
                
                $res = mysqli_query($conn, $sql);
                if($res){
                    //check no. of rows
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($rows = mysqli_fetch_assoc($res)){
                             //using loop to get all the data from db.

                            //get individual data
                            $id = $rows['ID'];
                            $name = $rows['Full_Name'];
                            $username = $rows['Username'];

                            //display the values in table
                            
                            ?> <!--breaking php to write html code  -->
                            <tr>
                                <td><?php echo $sr++;?></td>
                                <td><?php echo $name;?></td>
                                <td><?php echo $username;?></td>
                                <td>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>             
                            <?php

                        }
                    }
                }
                ?>
               
                </table>
            </div>
        </div>
        
<?php include("partials/footer.php"); ?>