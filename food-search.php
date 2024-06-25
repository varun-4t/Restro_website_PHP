<?php include("frontend-partials/header.php");?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image: url(images/bg.jpg);">
        <div class="container">
            <?php 
                // get the searched text
                $search = $_POST["search"];
            ?>            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            // sql query to get the foods based on searched text
            $sql = "SELECT * FROM food WHERE title like '%$search%' OR about LIKE '%$search%'";

            // execute the query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            // check whether food available or not 
            if($count>0){
                // food available
                while($row = mysqli_fetch_assoc($res) ){
                    $id = $row['ID'];
                    $title = $row['Title'];
                    $price = $row["Price"];
                    $about = $row["About"];
                    $img = $row["image_name"];
                    ?>
                
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // check whether img available or not
                            if($img==""){
                                // img not available
                                echo "<div class='error'>Image Not Available</div>";
                            }else{
                                // img available
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $img;?>" class="img-responsive img-curve">    
                                <?php
                            }
                            ?>
                            
                        </div>
        
                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail">
                                <?php echo $about;?>
                            </p>
                            <br>
        
                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                </div>

                <?php
                }

            }else{
                // not available
                echo "<div class='error'>Food Not Available</div>";
            }

            ?>


            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("frontend-partials/footer.php");?>