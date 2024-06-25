<?php include("frontend-partials/header.php");?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // display all the categories that are active
                $sql ="SELECT * FROM category WHERE active='Yes' ";
                // execute the query 
                $res = mysqli_query($conn, $sql);
                // count no of rows
                $count=mysqli_num_rows($res);
                // check whether categories available or not 
                if($count>0){
                    // category available
                    while($row=mysqli_fetch_assoc($res)){
                        // get the values
                        $id = $row['ID'];
                        $title = $row['Title'];
                        $img_name = $row['img_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>categry-food.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php 
                                if($img_name==""){
                                    // img not available
                                    echo "<div class='error'>Image Not Available</div>";        
                                }else{
                                    // img available
                                    ?>
                                     <img src="<?php echo SITEURL;?>images/category/<?php echo $img_name;?>" alt="Pizza" class="img-responsive img-curve">
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
                    echo "<div class='error'>Category Not Available</div>";
                }
            
            ?>        

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include("frontend-partials/footer.php");?>