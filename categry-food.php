<?php include("frontend-partials/header.php");?>

    <?php 
    // check whether id is passed or not
    if(isset($_GET['category_id'])){
        $category_id = $_GET["category_id"];
        // get category title based on category id
        $sql = "SELECT Title FROM category WHERE ID=$category_id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // get the value from database
        $row = mysqli_fetch_assoc($res);
        // get the title
        $title = $row["Title"];
    }else{
        // category not passed
        header("location:".SITEURL);
    }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image: url(images/bg.jpg);">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            // sql query to get food based on category
            $sql2 = "SELECT * FROM food WHERE Category_ID=$category_id";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count the rows
            $count = mysqli_num_rows($res2);

            // check if food is available or not
            if($count>0){
                // food available
                while($row2 = mysqli_fetch_assoc($res2)){
                    $id = $row2["ID"];
                    $title2 = $row2['Title'];
                    $price = $row2['Price'];
                    $about = $row2['About'];
                    $img = $row2['image_name'];
                    ?>
                     <div class="food-menu-box">
                        <div class="food-menu-img">
                         <?php
                            // check if img is available or not
                            if($img==""){
                                echo "<div class='error'>Image Not Found</div>";
                            }else{
                                ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $img;?>" class="img-responsive img-curve">        
                                <?php
                            }
                         ?>   
                        
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title2;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail">
                            <?php echo $about;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                     </div>
                    <?php
                }
            }else{
                // no category found
                echo "<div class='error'>Category Not Found</div>";
            }

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("frontend-partials/footer.php");?>