<!DOCTYPE HTML>
<?php

session_start();

include('include/dbconnection.php');
include('sidebar_customer.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

if (!isset($cust_id)) {
  header('location: login/process2.php');
  exit;
}

?>
<html>
<head>

	<title>F&J Multimedia</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/F&J.png" />
    <link  rel="stylesheet"  href="../assets/boxicon/boxicons.css" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	  
	
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
     <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>


</head>
<main id="main" class="main">
<body class="is-preload">

	<!-- Main -->
	<div id="main">

		<!-- Intro -->
    <div class="content-wrapper">
        <!-- Content -->

		
    <div class="container">
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">		            
                
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                FnJ Service
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Service Message</h5>
                                <p class="card-text">
                                Payment successful! Thank you for your payment.
                                </p>
                                <a href="createRequest.php" class="btn btn-primary">Home</a>
                                <a href="serviceInComing.php" class="btn btn-primary">See Status</a>
                            </div>
                        </div>
                    </div>
                									  
            </div>
        </div>
      </div>                                 
    </div>
  </div>
         

           <!-- / Content -->
  </main>

		<!-- Footer -->
    <?php include('footer.php'); ?>

		<!-- Scripts -->
		<script src="js/form.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollex.min.js"></script>
		<script src="js/browser.min.js"></script>
		<script src="js/breakpoints.min.js"></script>
		<script src="js/util.js"></script>
		<script src="js/main.js"></script>


	</body>	
</html>