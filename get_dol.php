<?php

    session_start();
    $who_email = $_SESSION["username"];
    require __DIR__ . '/connect.php';
    $output = "";
    // $socname = $_POST["socname"];
    if(isset($_POST["socname"])){
        if($_POST["socname"] != ""){
            $getdol = "SELECT date_of_loading FROM  product_info WHERE who_email = '$who_email' AND so_companyname = '".$_POST["socname"]."'";
            
        }
    }

    // $getdol = "SELECT date_of_loading FROM  product_info WHERE who_email = '$who_email' AND so_companyname = '".$q."'";
    $r_getdol = mysqli_query($conn,$getdol);
    while($row_getdol = mysqli_fetch_array($r_getdol)) {
        $output.= "<option value=".$row_getdol['date_of_loading'].">".$row_getdol['date_of_loading']."</option>";
    }

    echo $output;

?>