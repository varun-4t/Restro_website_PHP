<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        //get the id 
        $id = $_GET['id'];

        //create query 
        $sql = "SELECT * FROM admin WHERE id=$id";

        //execute query
        $res = mysqli_query($conn, $sql);

        if($res){
            $count = mysqli_num_rows($res);
            if($count==1){
                //get details
                $rows=mysqli_fetch_assoc($res);
                $name = $rows['Full_Name'];
                $username = $rows['Username'];
            }else{
                //redirect it to admin page
                header("location:".SITEURL."admin/admin.php");    
            }
        }else{
            echo "Error Occured";
        }
        ?>

        <form method="POST">
        <table class="tb-30"> 
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $name; ?>"></td>
                </tr>
                
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>   
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">    
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
if(isset($_POST['submit'])){
    //get values from the form 
    $id = $_POST['id'];
    $name=$_POST['full_name'];
    $username=$_POST['username'];

    //SQL Query
    $sql = "UPDATE admin SET Full_Name = '$name', username='$username' WHERE id='$id'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check query
    if($res){
        //query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        //redirect to admin page
        header("location:".SITEURL."admin/admin.php");
    }else{
        //query executed and admin updated
        $_SESSION['update'] = "<div class='error'>Admin Failed to Updated</div>";
        //redirect to admin page
        header("location:".SITEURL."admin/admin.php");
    }
}
?>

<?php include('partials/footer.php'); ?>
