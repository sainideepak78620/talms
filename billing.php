<?php  

    require 'php_sp/connect.php';
    // Don't edit below code

    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
        header("location: index.php");
        exit;
    }
    // Don't edit above code

    $showAlert = false;
    $showError = false;

    // fetching warehouse owner name 
    $who_email = $_SESSION["username"];
    $getwn_wc = "SELECT who_name FROM who_info WHERE who_email = '$who_email'";
    $r_getwn_wc = mysqli_query($conn,$getwn_wc);
    $who = mysqli_fetch_assoc($r_getwn_wc);

    // fetching Stock Owner company name 
    function get_company($conn){
        $output="";
        $who_email = $_SESSION["username"];
        $get_cn = "SELECT so_companyname FROM product_info WHERE who_email = '$who_email'";
        $r_cn = mysqli_query($conn,$get_cn);
        if (mysqli_num_rows($r_cn) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($r_cn)) {
                $output .= "<option value=".$row['so_companyname'].">".$row['so_companyname']."</option>";
              
            }
            return $output;
        }
    }
    

    function dateDifference($start_date, $end_date)
    {
        // calulating the difference in timestamps 
        $diff = strtotime($start_date) - strtotime($end_date);
        if($diff == 0){
            return 1;
        }
        // 1 day = 24 hours 
        // 24 * 60 * 60 = 86400 seconds
        return ceil(abs($diff / 86400));
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $so_companyname=$_POST["socname"];
        $so_name=$_POST["soname"];
        $who_name=$who['who_name'];
        $p_name=$_POST["pname"];
        $qty=$_POST["qty"];
        $dol=$_POST["dol"];
        $dop=date("Y-m-d");
        $who_email = $_SESSION["username"];

        $sql2 = "SELECT quantity,size_of_product FROM product_info WHERE so_companyname='$so_companyname' AND p_name = '$p_name' AND date_of_loading = '$dol' AND who_email = '$who_email' ";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);

        $cost=dateDifference($dol,$dop)*$row2['size_of_product']*$qty;

        $sql = "INSERT INTO bill_info (so_name,so_companyname,who_name,product_name,quantity,cost,date_of_loading,date_of_departing)
        VALUES ('$so_name','$so_companyname','$who_name','$p_name','$qty','$cost','$dol','$dop')";
        $result = mysqli_query($conn,$sql);

        
        $u_qty = $row2["quantity"] - $qty;
        $sql3 = "UPDATE product_info SET quantity = $u_qty  WHERE who_email = '$who_email' AND p_name = '$p_name' AND date_of_loading = '$dol' AND so_companyname = '$so_companyname'";
        $result3 = mysqli_query($conn,$sql3);
        
        $up_size = $row2["quantity"] * $row2["size_of_product"]; 
        $sql4 = "SELECT wh_size FROM who_info WHERE who_email = '$who_email'";
        $result4 = mysqli_query($conn,$sql4);
        $row4 = mysqli_fetch_assoc($result4);

        $u_size = $row4["wh_size"] + $up_size;
        $sql5 = "UPDATE who_info SET wh_size='$u_size' WHERE who_email = '$who_email'";
        $result5 = mysqli_query($conn,$sql5);
        
        if($result && $result2 && $result3){
            $showAlert = true;
        }
        else{
            $showError = "Bill is not generated 'TRY AGAIN!'";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WMS -Billing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    

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
                <strong>Success!</strong> Bill generated <a href="view_bill.php">View Bill</a>
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
        <h2 class="form-heading my-3">Billing Form</h2>
        <form action="billing.php" method="post" class="my-3 form-horizontal">
            <div class="form-group">
                <label for="socname" class="control-label col-sm-4 my-3"><b>Stock Owner Company Name:</b></label>
                <div class="col-sm-10">
                    <select name="socname" id="socname" class="form-control input-lg mx-1">
                        <option value="">Select Company</option>
                        <?php 
                            echo get_company($conn);
                        ?>    
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="soname" class="control-label col-sm-4 my-3"><b>Stock Owner Name:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="soname" class="form-control input-lg" name="soname" placeholder="Enter stock owner name"
                        title="This field is required" required>
                </div>
            </div>

			<div class="form-group">
                <label for="wh_name" class="control-label col-sm-4 my-3"><b>Warehouse name:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="wh_name" class="form-control input-lg" name="wh_name" readonly
                        title="This field is required" value="<?php echo $who['who_name']; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="pname" class="control-label col-sm-4 my-3"><b>Product Name:</b></label>
                <div class="col-sm-10">
                    <input type="text" id="pname" class="form-control input-lg" name="pname" placeholder="Enter product name"
                        title="This field is required" required>
                </div>
            </div>

            <div class="form-group">
                <label for="qty" class="control-label col-sm-4 my-3"><b>Quantity:</b></label>
                <div class="col-sm-10">
                    <input type="number" id="qty" class="form-control input-lg" name="qty"
                        placeholder="Enter quantity" title="This field is required" required>
                </div>
            </div>
            
			<div class="form-group">
                <label for="dol" class="control-label col-sm-4"><b>Date of Loading:</b></label>
                <div class="col-sm-10" >
                    <select name="dol" id="dol" class="form-control input-lg mx-1">
                        <option value="">Select Date</option>
                        <?php 
                            // echo get_date($conn);
                        ?>
                    </select>
                </div>
            </div>

            
            <!-- <div class="form-group">
                <label for="cost" class="control-label col-sm-4 my-3"><b>Cost: </b></label>
                <div class="col-sm-10">
                    <input type="number" id="cost" class="form-control input-lg" name="cost" placeholder="Enter price"
                        title="This field is required" required>
                </div>
                
            </div> -->

            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Submit" />
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

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      

</body>

</html>
<script>  
 $(document).ready(function(){  
      $('#socname').change(function(){  
           var socname = $(this).val();  
           $.ajax({  
                url:"php_sp/get_dol.php",  
                method:"POST",  
                data:{socname:socname},  
                success:function(data){  
                     $('#dol').html(data);  
                }  
           });  
      });  
 });  
 </script>