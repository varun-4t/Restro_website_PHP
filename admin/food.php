<?php include('partials/header.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Food</h1>
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['unauthorize'])){
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?>
        <br><br>
               <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br><br>
               <table class="table">
               
               <tr>
                    <th>SrNo</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    // create sql query to get all the food 
                    $sql = "SELECT * FROM food ";
                    
                    // execute query
                    $res = mysqli_query($conn, $sql);

                    // count the rows to check whether we have data or not
                    $count = mysqli_num_rows($res);

                    // creating serial number variable for id  and setting it default as 1
                    $srno = 1;
                    if ($count > 0) {
                        // we have data
                        // get food from database and display
                        while ($row = mysqli_fetch_assoc($res)) {
                            //get the values from individual values
                            $id = $row['ID'];
                            $title = $row['Title'];
                            $price = $row['Price'];
                            $img = $row['image_name'];
                            $featured = $row['Featured'];
                            $active = $row['Active'];
                            ?>
                            <tr>
                                <td><?php echo $srno++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                    //check whether we have img or not
                                    if ($img == "") {
                                        echo "<div class='error'>Image not available.</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $img;?>" width="100px;">
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $img; ?>" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // database is empty
                        echo "<tr><td colspan='7' class='error'>No data available</td></tr>";
                    }
                ?>
                </table>
    </div>
</div>

<?php include('partials/footer.php');?>