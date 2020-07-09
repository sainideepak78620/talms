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
        $p_name=$_POST["pname"];
        $qty=$_POST["qty"];
        $p_size=$_POST["psize"];
        $dol= date("Y-m-d");
        $who_email = $_SESSION["username"];

        $sql = "INSERT INTO product_info (who_email,so_companyname,p_name,quantity,size_of_product,date_of_loading)
        VALUES ('$who_email','$so_companyname','$p_name','$qty','$p_size','$dol')";

        $result = mysqli_query($conn,$sql);

        $up_size = $p_size * $qty;
        $sql2 = "SELECT wh_size from who_info WHERE who_email='$who_email'";
        $result2 = mysqli_query($conn,$sql2);
        $row = mysqli_fetch_assoc($result2);
        
        $u_size = $row["wh_size"]-$up_size;
        $sql3 = "UPDATE who_info SET wh_size='$u_size' WHERE who_email = '$who_email'";
        $result3 = mysqli_query($conn,$sql3);
        

        if($result){
            $showAlert = true;
        }
        else{
            $showError = "Product is not added 'TRY AGAIN!'";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS - Add Product</title>
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
                <strong>Success!</strong> Product is added
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
        <h2 class="form-heading my-3">Add Product</h2>
        <form action="add_product.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="socname" class="control-label col-sm-4 my-3"><b>Stock Owner Company Name:</b></label>
                <div class="col-sm-8">
                    <input type="text" id="socname" class="form-control input-lg" name="socname" placeholder="Enter company name"
                        title="This field is required" required>
                </div>
            </div>
            

			<div class="form-group">
                <label for="pname" class="control-label col-sm-4 my-3
                "><b>Product Name:</b></label>
                <div class="col-sm-8">
                    <input type="text" id="pname" class="form-control input-lg" name="pname" placeholder="Enter product name"
                        title="This field is required" required>
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="category" class="control-label col-sm-4 my-3
                "><b>Category:</b></label>
                <div class="col-sm-8">
                    <input type="text" id="category" class="form-control input-lg" name="catrgory" placeholder="Enter stock category"
                        title="This field is required"   required>
                </div>
            </div> -->
            <div class="form-group">
                <label for="qty" class="control-label col-sm-4 my-3
                "><b>Quantity:</b></label>
                <div class="col-sm-8">
                    <input type="number" id="qty" class="form-control input-lg" name="qty"
                        placeholder="Enter quantity" title="This field is required" required>
                </div>
            </div>
            <div class="form-group">
                <label for="psize" class="control-label col-sm-4 my-3
                "><b>Size of Product (in m<sup>3</sup>):</b></label>
                <div class="col-sm-8">
                    <input type="number" max="10000" id="psize" class="form-control input-lg" name="psize"
                        pattern="^\d{10}$"
                        title="This field is required and must contain only digits"
                        placeholder="Enter size of product" required>
                </div>
            </div>
			<!-- <div class="form-group">
                <label for="dol" class="control-label col-sm-4 my-3
                "><b>Date of Loading:</b></label>
                <div class="col-sm-8" >
                    <input type="date" id="dol"  class="form-control input-lg" name="dol"
                        placeholder="Enter date of loading" title="This field is required" required>
				</div>
            </div> -->
			<!-- <div class="form-group">
                <label for="dop" class="control-label col-sm-4 my-3
                "><b>Date of Departing:</b></label>
                <div class="col-sm-8">
                    <input type="date" id="dop"  class="form-control input-lg" name="dop"
                        placeholder="Enter date of loading" title="This field is required" required>
                </div>
            </div> -->
			
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
    
      

</body>

</html>