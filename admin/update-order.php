<?php include('partials/header.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
            // check whether id is set or not
            if(isset($_GET['id'])){
                // get order details
                $id = $_GET['id'];
                // query to get details
                $sql = "SELECT * FROM `order` WHERE id='$id'";
                // execute query
                $res = mysqli_query($conn, $sql);
                // count rows
                $count=mysqli_num_rows($res);
                // check whether data is there or not
                if($count==1){
                    // detail available
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['Food'];
                    $price = $row['Price'];
                    $qty = $row['Quantity'];
                    $status = $row['Food_Status'];
                    $customer_name = $row['Customer_Name'];
                    $customer_contact = $row['Customer_Contact'];
                    $customer_email = $row['Customer_Email'];
                    $customer_address = $row['Customer_Address'];
                }else{
                    // details not available
                    header("location:".SITEURL.'admin/order.php');
                }
                 

            }else{
                // redirect to order page
                header("location:".SITEURL.'admin/order.php');
            }
        ?>    

        <form action="" method="POST">
            <table class='table'>
                <tr>
                    <td>Food Name:</td>
                    <td><?php echo "<strong>$food</strong>";?></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><?php echo "<strong>$price</strong>";?></td>
                </tr>
                <tr>
                    <td>Quantity: </td>
                    <td><input type="number" name="qty" value='<?php echo $qty;?>'></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status" >
                            <option <?php if($status=="Ordered"){echo "selected";}?> value="ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";}?>value="on delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";}?> value="delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";}?>value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" value=" <?php echo $customer_name;?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact;?>"></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="email" name="customer_email" value="<?php echo $customer_email;?>"></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="customer_address"cols="25" rows="5" ><?php echo $customer_address;?></textarea></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update Order" class='btn-secondary'></td>
                </tr>
            </table>
        </form>    
<?php 
if(isset($_POST['submit'])){
    $ID = $_POST['id'];
    $Price = $_POST['price'];
    $Qty = $_POST['qty'];
    $total = $Price * $Qty;
    $Status = $_POST['status'];
    $cust_name = $_POST['customer_name'];
    $cust_contact = $_POST['customer_contact'];
    $cust_email = $_POST['customer_email'];
    $cust_address = $_POST['customer_address'];

    // update query
    $sql2 = "UPDATE `order` SET Quantity=$Qty, Total=$total, Food_Status='$Status', Customer_Name='$cust_name', Customer_Contact='$cust_contact', Customer_Email='$cust_email', Customer_Address='$cust_address' WHERE ID=$ID";
    // execute query
    $res2 = mysqli_query($conn, $sql2);
    // check if query updated or not
    if($res2){
        $_SESSION['update']="<div class='success'>Updated Successfully</div>";
        header("location:".SITEURL.'admin/order.php');
    }else{
        $_SESSION['update']="<div class='error'>Update Failed</div>";
        header("location:".SITEURL.'admin/order.php');
    }
}
?>
    </div>
</div>

<?php include('partials/footer.php');?>