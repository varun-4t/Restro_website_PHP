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
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // display foods that are active
                $sql = "SELECT * FROM food WHERE active='Yes'";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // count no. of rows
                $count = mysqli_num_rows($res);
                // check whether the food is available or not
                if($count>0){
                    // food available
                    while($row = mysqli_fetch_assoc($res)){
                        // get the values
                        $id = $row["ID"];
                        $title = $row["Title"];
                        $about = $row["About"];
                        $price = $row["Price"];
                        $img = $row["image_name"];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="images/food/<?php echo $img;?>" class="img-responsive img-curve"> 
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price"><?php echo $price;?></p>
                                    <p class="food-detail"><?php echo $about;?></p><br>
                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>    
                        <?php
                    }
                            }else{
                                // food not available
                                echo "<div class='error'>Food Not Available</div>";
                            }
                        ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("frontend-partials/footer.php");?>