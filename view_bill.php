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

    $sql = "SELECT * FROM bill_info";
    $result = mysqli_query($conn,$sql);
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - View Bill</title>
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
    
    
    <!-- insert table here (start) -->


	<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container my-3">
  <h2 class="form-heading my-3">Bills</h2>

	<table class="table table-striped">
	
    <thead>
      <tr>
        <th>Bill ID</th>
        <th>Stock Owner Name</th>
        <th>Stock Owner Company Name</th>
        <th>Warehouse Owner Name</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Date of Loading</th>
        <th>Date of Departing</th>
        <th>Cost</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          while($row= mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row["bill_id"]."</td>";
            echo "<td>".$row["so_name"]."</td>";
            echo "<td>".$row["so_companyname"]."</td>";
            echo "<td>".$row["who_name"]."</td>";
            echo "<td>".$row["product_name"]."</td>";
            echo "<td>".$row["quantity"]."</td>";
            echo "<td>".$row["date_of_loading"]."</td>";
            echo "<td>".$row["date_of_departing"]."</td>";
            echo "<td>".$row["cost"]."</td>";
            echo "</tr>";
          }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>


    
    <!-- table end -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php require 'partials/_footer.php' ?>

    
      

</body>

</html>