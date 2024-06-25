<?php include('../config/constants.php');?>

<html>
    <head>
        <title>WoWFood Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
<?php
if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if(isset($_SESSION['no-login-msg'])){
    echo $_SESSION['no-login-msg'];
    unset($_SESSION['no-login-msg']);
}
?>
<br><br>
            <form method="POST" class="text-center">
                Username: <input type="text" name="username" placeholder="Username"><br><br>
                Password: <input type="password" name="password" placeholder="Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
            </form>
            <p class="text-center">By: Varun Tahiliani</p>
        </div>
    </body>
</html>

<?php 
//check if submit button is clicked or not
if(isset($_POST['submit'])){
    //get the data from the form 
    $username = $_POST['username'];
    $password = $_POST['password']; //bcoz we're using encrypted password in database

    //creating sql query to check whether username & password exist or not
    $sql = "SELECT * FROM admin WHERE Username='$username' AND Password='$password'"; 

    //execute sql query
    $res = mysqli_query($conn, $sql);
    if($res){
        
        //checking if user exist or not
        $count = mysqli_num_rows($res);
        if($count==1){
            
            //user exist
            $_SESSION['login'] = '<div class="success text-center">Logged In</div>';

            //to check whether user is logged in or not and logout will unset it 
            $_SESSION['user'] = $username;    

            //redirecting it
            header("location:".SITEURL."admin/index.php");

        }else{
            //user not exist
            $_SESSION['login'] = '<div class="error text-center">Incorrect username or password</div>';
            header("location:".SITEURL."admin/login.php");
        }

    }
}

?>