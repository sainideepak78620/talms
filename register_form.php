<?php
    $showAlert = false;
    $showError = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require 'php_sp/connect.php';

        $cpass = $_POST["cpass"];
        $who_name=$_POST["fname"];
        $who_contact=$_POST["contact"];
        $who_email=$_POST["email"];
        $pass=$_POST["pass"];
        $wh_size=$_POST["wh_size"];
        $wh_address=$_POST["address"];
        $wh_cost=$_POST["cost"];
        
        // $exists = false;
        $sql = "select * from who_info where who_email = '$who_email'";
        $r = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($r);
        if($num > 0){
            // $exists = true;
            $showError = "Your email id already exists";
        }
        else{
            $exists = false;
        }

        if($pass == $cpass){
            $sql = "INSERT INTO who_info (who_email,who_name,who_contact,who_password,wh_address,wh_size,cost_per_m3)
			VALUES ('$who_email','$who_name','$who_contact','$pass','$wh_address','$wh_size','$wh_cost')";
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Use same password in 'Password and Confirm Password field' ";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - Registration Form</title>
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

<nav class="form-heading navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Warehouse Management System</a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

    </nav>

    <?php 
        if($showAlert){
            echo '<div class="form-heading alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Your account is now created and you can login <a href="index.php">Click Here</a>
            </div>';
        }
        if($showError){
            echo '<div class="form-heading alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning! </strong>'. $showError .'
            </div>';
        }
    ?>

    <div class="container">
        <h2 class="form-heading my-3">Warehouse Owner Registeration Form</h2>
        <form action="register_form.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="fname" class="control-label col-sm-2 my-3"><b>Full name of Owner:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="fname" class="form-control input-lg" name="fname" placeholder="Enter your full name"
                        title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <label for="contact" class="control-label col-sm-2 my-3"><b>Contact:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="contact" pattern="^\d{10}$" class="form-control input-lg" name="contact" placeholder="Enter your contact"
                        title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2 my-3"><b>Email ID:</b></label>
                <div class="col-sm-10">
                    <input type="email" id="email" class="form-control input-lg" name="email"
                        placeholder="Enter your email address" title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <label for="pass" class="control-label col-sm-2 my-3"><b>Password:</b></label>
                <div class="col-sm-10">
                    <input type="password" id="pass" class="form-control input-lg" name="pass"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="This field is required and must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                        placeholder="Enter your password" required>
                    <br>
                    <input type="password" id="cpass" class="form-control input-lg" name="cpass"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="This field is required and must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                        placeholder="Confirm password" required>
                    <br>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="control-label col-sm-2 my-3"><b>Address:</b></label>
                <div class="col-sm-10">
                    <textarea id="email" class="form-control input-lg" name="address"
                        placeholder="Enter warehouse address" title="This field is required" required></textarea>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="section" class="control-label col-sm-2 my-3"><b>Sections:</b></label>
                <div class="col-sm-10">
                    <input type="number" id="section" class="form-control input-lg" name="section" placeholder="Enter number of sections in Warehouse"
                        title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <label for="wh_size" class="control-label col-sm-2 my-3"><b>Size in meter<sup>3</sup>:</b></label>
                <div class="col-sm-10">
                    <input type="number" id="wh_size" class="form-control input-lg" name="wh_size" placeholder="Enter the size of warehouse"
                        title="This field is required" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="cost" class="control-label col-sm-2 my-3"><b>Cost per meter<sup>3</sup>:</b></label>
                <div class="col-sm-10">
                    <input type="number" id="cost" class="form-control input-lg" name="cost" placeholder="Enter price"
                        title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Submit" />
                    <input type="reset" name="submit" class="btn btn-danger btn-lg" value="Reset" />
                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php require "partials/_footer.php" ?>

	<script src="assets/showPassword.js"></script>
      

</body>

</html>