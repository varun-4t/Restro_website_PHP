<?php include("partials/header.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>  
         <br><br>   
        <form method="POST"> 
            <table class="tb-30"> 
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder='Enter Your Name'></td>
                </tr>
                
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder='Username'></td>
                </tr>   
                
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder='Enter Password'></td>
                </tr>   

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">    
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php");?>

<!-- $_POST is an associative array that contains key-value pairs of data sent to the server in the POST request. 
 The keys are the names of the form fields, and the values are the data entered by the user. -->
<?php
    if(isset($_POST['submit']))//isset funtion is used to check whether the value is set or not, in this context it will check if data is submitted using post method
    { 
        $name = $_POST['full_name']; 
        $username = $_POST['username']; 
        $password = $_POST['password']; 
        

        $sql = "INSERT INTO admin SET full_name='$name', username='$username', password='$password' "; 
        //no need to add ID as it is set to auto increment, it will increase automatically
        
        $res = mysqli_query($conn, $sql);       
        
        if($res){               
            $_SESSION['add'] = "<div class='success'>Added Successfully</div>";
            //redirecting page
            header("location:".SITEURL."admin/admin.php");
        }else{
            $_SESSION['add'] = "<div class='error'>Failed to add</div>";
            //redirecting page
            header("location:".SITEURL."admin/add-admin.php");
        }

    }
?>
 