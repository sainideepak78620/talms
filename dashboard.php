<?php  

    require 'php_sp/connect.php';
    // Don't edit the code below

    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
        header("location: index.php");
        exit;
    }

    // Don't edit the code above
    $who_email = $_SESSION["username"];
    $sql = "SELECT who_name,wh_size FROM who_info WHERE who_email='$who_email'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - Dashboard</title>
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

    <!-- Navbar End -->
    

    <div class="container">
        <div class="jumbotron my-3">
            <h2>Welcome <?php echo $row['who_name'] ?></h2>
            <h3>Available Space: <?php echo $row['wh_size'] ?></h3>
        </div>
        <div class="row">
            <div class="col col-sm-6">
                <div class="card text-center" style="width: 18rem;">
                    <img class="card-img-top img-rounded" src="https://source.unsplash.com/286x180/?grain" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title">Add Product</h3>
                        <p class="card-text">Click button to add Product.</p>
                        <a href="add_product.php" class="btn btn-info">Add Product</a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="card text-center" style="width: 18rem;">
                    <img class="card-img-top img-rounded" src="https://source.unsplash.com/286x180/?payment" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title">Make Bill</h3>
                        <p class="card-text">Click button to make Bill.</p>
                        <a href="billing.php" class="btn btn-success">Make Bill</a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php require 'partials/_footer.php' ?>

    
	<script src="showPassword.js"></script>
      

</body>

</html>