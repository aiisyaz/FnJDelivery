<!DOCTYPE HTML>
<?php

session_start();

include('include/config.php');
include('sidebar_customer.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];
$service_id = $_SESSION['service_id'];

if (!isset($cust_id)) {
  header('location: login/process.php');
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
		<!-- <section class="one dark cover"> -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

		<!-- Intro -->
		
    <div class="container">
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">		            
                <div class="modal-body">
                    <div class="bs-stepper-content border-top">
                        <form id="wizard-checkout-form" method ='POST' action ="process-createPayment.php">
                            <!-- Cart -->
                            <div id="checkout-cart" class="content fv-plugins-bootstrap5 fv-plugins-framework active dstepper-block">
                                <div class="row">
                                    <div class="container-xxl flex-grow-1 container-p-y"></div>

                                    <!-- Offer -->
                                    <h6>Payment Details</h6>
                                    <div class="row g-3 mb-3">
                                        <?php
                                            $select_customer = mysqli_query($conn, "SELECT 
                                            c.CUSTOMERID,
                                            c.CUSTOMERNAME,
                                            c.CUSTOMERPHONENUMBER,
                                            s.SERVICENAME,
                                            s.SERVICEPRICE,
                                            COALESCE(sd.SERVICEDETAILSINVOICENUM, '-') AS INVOICENUM,
                                            sd.SERVICEDETAILSID,
                                            sd.SERVICEDETAILSTIMESTAMP,
                                            sd.SERVICEDETAILSLOCATION,
                                            sd.SERVICEDETAILSINVOICENUM
                                            FROM 
                                                SERVICE s
                                            JOIN 
                                                SERVICEDETAILS sd ON s.SERVICEID = sd.SERVICEID         
                                            JOIN 
                                                CUSTOMER c ON sd.CUSTOMERID = c.CUSTOMERID
                                            WHERE SERVICEDETAILSID = '$service_id'");

                                          

                                            if ($row = mysqli_fetch_assoc($select_customer)) {
                                        ?>

                                        <input
                                        type="hidden"
                                        name = "custid"
                                        value="<?php echo $row['CUSTOMERID']; ?>">
                                        <input
                                        type="hidden"
                                        name = "servicedetails"
                                        value="<?php echo $row['SERVICEDETAILSID']; ?>">
                                            
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label class="form-label">Customer Name: <?php echo $row['CUSTOMERNAME']; ?></label> <br>
                                                <label class="form-label">Phone Number: <?php echo $row['CUSTOMERPHONENUMBER']; ?></label> <br>
                                                <label class="form-label">Service Address: <?php echo $row['SERVICEDETAILSLOCATION']; ?></label> <br>
                                                <label class="form-label">Service Type: <?php echo $row['SERVICENAME']; ?></label> <br>
                                            </div>
                                        </div>
                                        
                                        <?php }?>
                                    </div>

                                    <!-- device details -->
                                    <div class="bg-lighter rounded p-3">
                                        <table>
                                            <thead>
                                                <tr>
                                                <th>No.</th>
                                                <th>Device ID</th>  
                                                <th>Device Name</th>
                                                <th>Device Type</th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $counter = 1;
                                                $query = "SELECT d.DEVICEID, d.DEVICETYPE, d.DEVICENAME
                                                        FROM SERVICEDETAILS sd
                                                        JOIN SERVICEDETAILSDEVICE sdv ON sd.SERVICEDETAILSID = sdv.SERVICEDETAILSID
                                                        JOIN DEVICE d ON sdv.DEVICEID = d.DEVICEID 
                                                        WHERE sdv.SERVICEDETAILSID = '$service_id'";

                                                $queryDevice = mysqli_query($conn, $query);
                                                

                                                // Initialize total device count
                                                $total = 0;

                                                // Fetch data from the result set
                                                while ($fetch_service = mysqli_fetch_assoc($queryDevice)) {
                                                    // Your existing code for processing each row goes here
                                                ?>
                                                <tbody>
                                                    <tr style="color:#333;">
                                                        <td><?php echo $counter++; ?></td>
                                                        <td><i name="deviceID"></i> <strong><?php echo $fetch_service['DEVICEID']; ?></strong></td>
                                                        <td><?php echo $fetch_service['DEVICENAME']; ?></td>
                                                        <td><div name="type"><?php echo $fetch_service['DEVICETYPE']; ?></div></td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                                    // Increment total device count for each fetched device
                                                    $total++;
                                                } 
                                                ?>

                                                </table>
                                                </div>

                                                <!-- Display the total device count -->
                                                <dl class="row mb-0">
                                                    <dt class="col-6"></dt>
                                                    <dd class="col-6 fw-medium text-end mb-0" name="total">Total Device: <?php echo $total; ?> unit</dd>
                                                </dl>


                                        
                                    <hr class="mx-n4">

                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <?php
                                        $select_customer = mysqli_query($conn, "SELECT 
                                            s.SERVICEPRICE,
                                            COUNT(*) * MAX(s.SERVICEPRICE) AS TOTAL_COST
                                        FROM 
                                            SERVICE s
                                        JOIN 
                                            SERVICEDETAILS sd ON s.SERVICEID = sd.SERVICEID
                                        JOIN 
                                            SERVICEDETAILSDEVICE sdv ON sd.SERVICEDETAILSID = sdv.SERVICEDETAILSID
                                        JOIN
                                            DEVICE d ON sdv.DEVICEID = d.DEVICEID          
                                        JOIN 
                                            CUSTOMER c ON d.CUSTOMERID = c.CUSTOMERID
                                        WHERE 
                                            sdv.SERVICEDETAILSID = '$service_id'
                                        GROUP BY
                                            s.SERVICEPRICE");

                                        if ($row = mysqli_fetch_assoc($select_customer)) {
                                        ?>
                                        <dl class="row mb-0">
                                            <dt class="col-6 fw-normal">Service Charges</dt>
                                            <dd class="col-6 text-end">RM <?php echo $row['SERVICEPRICE']; ?></dd>
                                        </dl>

                                        
                                        <hr class="mx-n4">
                                        <!-- Price Details -->
                                        <h6>Payment Method</h6>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pay" id="bc1" checked value="Credit Card">
                                                    <label class="form-check-label" for="bc1"><i class="fa fa-cc-visa"></i> Credit Card</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pay" id="bc2" value="Online Banking">
                                                    <label class="form-check-label" for="bc2"><i class="fa fa-cc-bank"></i> FPX</label>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <hr class="mx-n4">
                                        <dl class="row mb-0">
                                            <dt class="col-6">Total</dt>
                                            <dd class="col-6 fw-medium text-end mb-0">RM <?php echo $row['TOTAL_COST']; ?></dd>
                                            <input type="hidden" name="totalPrice" value="<?php echo $row['TOTAL_COST']; ?>">
                                        </dl>
                                        <?php } ?>

                                    <div class="d-grid">
                                        <button type = "submit" name = "submit" class="btn btn-primary btn-next">Pay</button>
                                    </div>
                                </div>
                            </div>                            
                        </form>
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


<script src="js/form.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.scrolly.min.js"></script>
<script src="js/jquery.scrollex.min.js"></script>
<script src="js/browser.min.js"></script>
<script src="js/breakpoints.min.js"></script>
<script src="js/util.js"></script>
<script src="js/main.js"></script>

</script>

</body>	
</html>