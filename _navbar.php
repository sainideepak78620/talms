<?php  

    require 'php_sp/connect.php';
    // session_start();
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home1.php">Warehouse Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_stock_owner.php">Add Stock Owner</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cp.php">Change Price</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view_bill.php">View Bill</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
            <a href="logout.php" class="btn btn-outline-warning my-2 my-sm-0" type="submit">Logout</a>
          </form>
        </div>
      </nav>';        
    }
    else{
      echo '<nav class="form-heading navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home1.php">Warehouse Management System</a>
        // <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        //     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        //     <span class="navbar-toggler-icon"></span>
        // </button> 

    </nav>';
    }

?>