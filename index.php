<?php
    $login = false;
    $showError = false;
    error_reporting(0);
    // Don't edit below code
    session_start();
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
        header("location: dashboard.php");
        exit;
    }
    // else {
    //     header("location: index.php");
    //     exit;
    // }
    // Don't edit above code
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require 'php_sp/connect.php';
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        // $exists = false;
        $sql = "select * from who_info where who_email='$email' AND who_password='$pass'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $num = mysqli_num_rows($result);
        if($num==1){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $email;
            $_SESSION['price'] = $row['cost_per_m3'];
            header("location: dashboard.php");
        }
        else{
            $showError = "Invalid username or password";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="assets/style.css">

    
</head>

<body style="background: linear-gradient(to right, #ccffff 0%, #ffffcc 100%); ">

    <!-- Navbar End -->
    <nav class="form-heading navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Warehouse Management System</a>
    </nav>
    <!-- Navbar End -->

    <?php 
        // if($showAlert){
        //     echo '<div class="alert alert-success alert-dismissible">
        //         <button type="button" class="close" data-dismiss="alert">&times;</button>
        //         <strong>Success!</strong> Your account is now created and you can login
        //     </div>';
        // }
        if($showError){
            echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning! </strong>'. $showError .'
            </div>';
        }
    ?>

    <!-- Form End -->
    <div class="container my-3">
        <h1 class="form-heading">Login</h1>
        <form class="form-heading" method="post" action="index.php">
            <div class="form-group col-md-4">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group col-md-4">
              <label for="pass">Password</label>
              <input type="password" class="form-control" id="pass" name="pass">
              <i id="eye_icon" class="fa fa-eye" aria-hidden="true" onClick="showPass()">&nbsp;Show Password</i>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-info" style="color: white;">Submit</button>
                <a class="btn btn-success" style="color: white;" href="register_form.php">Register</a>
            </div>
        </form>
    </div>
    <!-- Form End -->

    <!-- Footer Start -->
    <?php require 'partials/_footer.php' ?>
    <!-- Footer End -->

    <!-- Scripts -->
	<script src="assets/showPassword.js"></script>
	<script type="text/javascript">
		function a(){
			alert("Username or password is invalid Try Again!");
		}
	</script>
</body>

</html>