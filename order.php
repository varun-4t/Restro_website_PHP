<?php include("frontend-partials/header.php");?>

<?php 
// check whether food_id is available or not
if(isset($_GET['food_id'])){
    // if food id available, then get the details of selected food
    $food_id= $_GET['food_id'];

    // getting details from database
    $sql = "SELECT * FROM food WHERE ID='$food_id'";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // count the rows
    $count = mysqli_num_rows($res);

    // check whether data is available or not
    if($count>0){
        // data is available, get data from database
        $row = mysqli_fetch_assoc($res);
        $title = $row['Title'];
        $price = $row['Price'];
        $about = $row["About"];
        $img = $row["image_name"];
    }else{
        // redirect to home page
        header("location:".SITEURL);
    }

}else{
    // redirect to home page
    header("location:".SITEURL);
}
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search" style="background-image: url(images/bg.jpg);">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>
                    <div class="food-menu-img">
                    <?php 
                        if($img==""){
                            echo "<div class='error'>Image Not Available.</div>";
                        }else{
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $img;?>" alt="<?php echo $title; ?>"  class="img-responsive img-curve">        
                            <?php
                        }
                    ?>
                    
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title ;?></h3>
                        <input type="hidden" name="food_name" value="<?php echo $title;?>">       

                        <p class="food-price"><?php echo $price ;?></p>
                        <input type="hidden" name="food_price" value="<?php echo $price;?>">        
                        
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Varun Tahiliani" class="input-responsive"
                        required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@varun.com" class="input-responsive"
                        required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                        required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            // check whether submit button clicked or not
            if(isset($_POST['submit'])){
                // get all the details from the form
                $name = $_POST['food_name'];
                $food_price = $_POST['food_price'];
                $qty = $_POST['qty'];
                $total = $food_price * $qty; 
                $order_data = date("Y-m-d h:i:s a");  //order date
                $status = "Ordered"; //ordered, On delivery, Delivered, Cancelled   
                $cust_name = $_POST['full-name'];
                $cust_number = $_POST['contact'];
                $cust_mail = $_POST['email'];
                $cust_address = $_POST['address'];

                // save the order in database for that we'll create sql query
                $sql2 = "INSERT INTO `order` SET food='$name',price=$price,quantity=$qty,total=$total,order_date='$order_data',food_status='$status',customer_name='$cust_name',customer_contact='$cust_number',customer_email='$cust_mail',customer_address='$cust_address'";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check whether query executed successfully or not
                if($res2==true){
                    // query executed successfully
                    $_SESSION['order']="<div class='success text-center' style='color:green;'> Order Placed</div>";
                    header("location:".SITEURL);
                }else{
                    // query not executed successfully
                    $_SESSION['order']="<div class='error text-center'>Order Not Placed</div>";
                    header("location:".SITEURL);
                }
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include("frontend-partials/footer.php");?>