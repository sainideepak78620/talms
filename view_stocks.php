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

    $sql = "SELECT * FROM so_info WHERE who_email='$who_email'";
    $result = mysqli_query($conn,$sql);
	$sql2="SELECT * FROM product_info WHERE who_email='$who_email'";
	$result2=mysqli_query($conn,$sql2);
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - View Stocks</title>
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
  <h2 class="form-heading my-3">Stocks</h2>

	<table class="table table-striped">
	
    <thead>
      <tr>
        <th>Company Name</th>
        <th>Stock Owner Name</th>
        <th>Contact</th>
        <th>Email id</th>

        
      </tr>
    </thead>
    <tbody>
      <?php 
          $num = mysqli_num_rows($result);
		  
          if($num>0){
              while($row= mysqli_fetch_assoc($result)){
                echo "<tr>";
				echo "<td>".$row["so_companyname"]."</td>";
				echo "<td>".$row["so_name"]."</td>";
                echo "<td>".$row["so_contact"]."</td>";
                echo "<td>".$row["so_email"]."</td>";
                echo "</tr>";

              }
          }
      ?>
    </tbody>
  </table>
</div>	
<br>
<br>
  <h2 class="form-heading my-3">Products</h2>

	<table class="table table-striped">
	
    <thead>
      <tr>
        <th>Company Name</th>
        <th>Product  Name</th>
		<th>Quantity</th>
		<th>Size of Product</th>
        <th>Date of Loading</th>
        <th>Date of Departing</th>
		
        
        
      </tr>
    </thead>
    <tbody>
      <?php 
          $num2 = mysqli_num_rows($result2);
		  
          if($num2>0){
              while($row2= mysqli_fetch_assoc($result2)){
                echo "<tr>";
				echo "<td>".$row2["so_companyname"]."</td>";
				echo "<td>".$row2["p_name"]."</td>";
                echo "<td>".$row2["quantity"]."</td>";
				echo "<td>".$row2["size_of_product"]."</td>";
				echo "<td>".$row2["date_of_loading"]."</td>";
                echo "<td>".$row2["date_of_departing"]."</td>";
                echo "</tr>";

              }
          }
      ?>
    </tbody>
  </table>

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