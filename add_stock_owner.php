<?php  

    require 'php_sp/connect.php';

    // Don't edit the below code

    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
        header("location: index.php");
        exit;
    }
    // Don't edit the above code

    $showAlert = false;
    $showError = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $so_companyname=$_POST["socname"];
        $so_name=$_POST["soname"];
        $so_contact=$_POST["contact"];
        $so_email=$_POST["soemail"];
        $who_email = $_SESSION["username"];

        $sql = "INSERT INTO so_info (who_email,so_email,so_companyname,so_name,so_contact)
        VALUES ('$who_email','$so_email','$so_companyname','$so_name','$so_contact')";

        $result = mysqli_query($conn,$sql);

        if($result){
            $showAlert = true;
        }
        else{
            $showError = "Stock onwer is not added 'TRY AGAIN!'";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - Stock Owner</title>
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

<?php require "partials/_navbar.php" ?>

    <?php 
        if($showAlert){
            echo '<div class="form-heading alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Stock Owner added.
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
        <h2 class="form-heading my-3">Stock Owner Registeration Form</h2>
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="socname" class="control-label col-sm-2 my-3"><b>Company name:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="socname" class="form-control input-lg" name="socname" placeholder="Enter stock owner company name"
                        title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <label for="soname" class="control-label col-sm-2 my-3"><b>Stock Owner name:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="soname" class="form-control input-lg" name="soname" placeholder="Enter stock owner name"
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
                <label for="soemail" class="control-label col-sm-2 my-3"><b>Email ID:</b></label>
                <div class="col-sm-10">
                    <input type="email" id="soemail" class="form-control input-lg" name="soemail"
                        placeholder="Enter your email address" title="This field is required" required>
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

	<script src="showPassword.js"></script>
      

</body>

</html>