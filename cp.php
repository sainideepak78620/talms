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
    $who_email = $_SESSION['username'];
    // $c_price = "SELECT cost_per_m3 FROM who_info WHERE who_email = '$who_email'";
    // $result1 = mysqli_query($conn,$c_price);
    // $row = mysqli_fetch_assoc($result1);

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $new_price = $_POST['nprice'];
        $who_email = $_SESSION["username"];

        $sql = "UPDATE who_info SET cost_per_m3 = '$new_price' WHERE who_email = '$who_email'";

        $result = mysqli_query($conn,$sql);

        if($result){
            $showAlert = true;
            $_SESSION['price'] = $new_price;
        }
        else{
            $showError = "Price is not changed 'TRY AGAIN!'";
        }
    }
    $c_price = "SELECT cost_per_m3 FROM who_info WHERE who_email = '$who_email'";
    $result1 = mysqli_query($conn,$c_price);
    $row = mysqli_fetch_assoc($result1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - Change Price</title>
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
            // header("location: cp.php");
            echo '<div class="form-heading alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Price has been changed <a href="cp.php">Click Here</a> to refresh.
            </div>';
        }
        if($showError){
            echo '<div class="form-heading alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning! </strong>'. $showError .'
            </div>';
        }
    ?>
    <div class="container my-3">
        <h2 class="form-heading my-3">Change Price</h2>
        <form class="form-heading" method="post" action="cp.php">
            <div class="form-group col-md-4">
              <label for="c_price">Current Price</label>
              <input type="number" class="form-control" id="c_price" name="c_price" value="<?php echo $row['cost_per_m3']; ?>"readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="nprice">New Price</label>
              <input type="number" class="form-control" id="nprice" name="nprice" placeholder="Enter new price">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-warning" style="color: white;">Change Price</button>
            </div>
        </form>
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