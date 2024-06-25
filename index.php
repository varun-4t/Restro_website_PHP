<?php include("frontend-partials/header.php");?>

<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image: url(images/bg.jpg);">
        <div class="container">
            
            <form action="<?php SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- FOOD SEARCH Section Ends Here -->

    <?php 
    if(isset($_SESSION['order'])){
        echo $_SESSION["order"];
        unset($_SESSION['order']);
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            // create sql query to display category form database   
            $sql = "SELECT * FROM  category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            // execute the query
            $res = mysqli_query($conn, $sql);

            // count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0){
                // category available 
                while($row = mysqli_fetch_assoc($res)){
                    // get the values id, title, img name
                    $id = $row['ID'];
                    $title = $row['Title'];
                    $img = $row['img_name'];
                    ?>
                    
                    <a href="<?php echo SITEURL;?>categry-food.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php
                            // check if img is available or not 
                            if($img==""){
                                echo "<div class='erro'>Image not available</div>";
                            }
                            else{
                                // img available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $img; ?>" alt="Pizza" class="img-responsive img-curve">          
                                <?php
                            }
                            ?>
                            
                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>

                    <?php
                }
            }else{
                // category not available
                echo "<div class='error'>No Category Available.<div>";
            }
            ?>


            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // get all food items from the database that are active and featured
                // sql query
                $sql2 = "SELECT * FROM food where active='Yes' AND featured='Yes' LIMIT 6";
                // execute the query
                $res2 = mysqli_query($conn,$sql2);
                // count the rows
                $count2 = mysqli_num_rows($res2);
                // check whether food available or not
                if($count2>0){
                    // food available 
                    while($row=mysqli_fetch_assoc($res2)){
                        // get all the values
                        $id2 = $row['ID'];
                        $title2 = $row['Title'];
                        $about = $row['About'];
                        $price = $row['Price'];
                        $img2 = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                // check whether img available or not 
                                if($img2==""){
                                    // img not avaiable
                                    echo "<div class='error'>Image Not Available </div>";
                                }else{
                                    // img available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $img2;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">    
                                    <?php 
                                }
                                ?>
                                
                            </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title2; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $about; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id2;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                        <?php    

                    }
                }else{
                    // food not available 
                    echo "<div class='error'>Food Not Available </div>";
                }

            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("frontend-partials/footer.php");?>