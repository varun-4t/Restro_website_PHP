<?php include('partials/header.php');?>


<div class="main-content" >
    <div class="wrapper" style="width:100%;">
        <h1>Order</h1>
        <?php
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}?>
        <br><br>
               <table class="table" style="width:100%;">               
                    <tr>
                        <th>SrNo</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order_Date</th>
                        <th>Food_Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                        
                            <?php 
                            // get details from database
                            $sql = "SELECT * FROM `order`";

                            // execute query
                            $res = mysqli_query($conn, $sql);

                            //creating serial number variable and initialize it by 1
                            $sr = 1;

                            // count the rows
                            $count = mysqli_num_rows($res);

                            if($count>0){
                                // data available
                                while($row = mysqli_fetch_assoc($res)){
                                    // get all the order details
                                    $id = $row['ID'];
                                    $food = $row['Food'];
                                    $price = $row['Price'];
                                    $qty = $row['Quantity'];
                                    $total = $row['Total'];
                                    $date = $row['Order_Date'];
                                    $status = $row['Food_Status'];
                                    $name = $row['Customer_Name'];
                                    $contact = $row['Customer_Contact'];
                                    $email = $row['Customer_Email'];
                                    $address = $row['Customer_Address'];
                                    ?>

                                    <tr>
                                        <td><?php echo $sr++;?></td>
                                        <td><?php echo $food;?></td>
                                        <td><?php echo $price;?></td>
                                        <td><?php echo $qty;?></td>
                                        <td><?php echo $total;?></td>
                                        <td><?php echo $date;?></td>
                                        <td><?php echo $status;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $contact;?></td>
                                        <td><?php echo $email;?></td>
                                        <td><?php echo $address;?></td>
                                        <td>
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                                        </td>
                                    </tr>                
                                    
                                    <?php 
                                }
                                
                            }else{
                                // data not available
                                echo "<tr><td colspan='12' class='error'>Order Not Available</td></tr>";
                            }
                            ?>
                    
               
                </table>
    </div>
</div>

<?php include('partials/footer.php');?>