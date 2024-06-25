<?php include("partials/header.php"); ?>
     

        <!-- Main Section -->
        <div class="main-content">
            <div class="wrapper">
               <h2>DASHBOARD</h2>
               <br><br>
               <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
               
               <div class="col-4 text-center">
               <?php 
            //    sql query
               $sql = "SELECT * from category";
            //    execute query
               $res = mysqli_query($conn, $sql);
           //     count number of rows 
               $count = mysqli_num_rows($res);
               ?>

               <h1><?php echo $count;?></h1> 
               <br>
               Categories
                </div>
               
               <div class="col-4 text-center">
               <?php 
            //    sql query
               $sql2 = "SELECT * from food";
            //    execute query
               $res2 = mysqli_query($conn, $sql2);
           //     count number of rows 
               $count2 = mysqli_num_rows($res2);
               ?>
               <h1><?php echo $count2;?></h1> 
               <br>
               Food
               </div>
               
               <div class="col-4 text-center">
               <?php 
            //    sql query
               $sql3 = "SELECT * from `order`";
            //    execute query
               $res3 = mysqli_query($conn, $sql3);
           //     count number of rows 
               $count3 = mysqli_num_rows($res3);
               ?>
               <h1><?php echo $count3;?></h1> 
               <br>
               Total Orders
               </div>
               
               <div class="col-4 text-center">
                <?php 
                // create sql query to get total revenue
                // Aggregate function  
                $sql4 = "SELECT SUM(total) AS total FROM `order` WHERE Food_Status='Delivered'";

                // execute query
                $res4 = mysqli_query($conn, $sql4);

                // get the value
                $row4 = mysqli_fetch_assoc($res4);

                // get the total revenue
                $total_rev = $row4['total'];
                ?>
               <h1><?php if($total_rev>0){echo $total_rev;}else{echo "No Revenue";} ?></h1> 
               <br>
               Revenue Generated
               </div>

                <div class="clearfix"></div>        
            </div>
            
        </div>
<?php include('partials/footer.php');?>