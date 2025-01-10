<?php
session_start();

include('include/dbconnection.php');
include('sidebar_customer.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

// if (!isset($cust_id)) {
//   header('location: login/process2.php');
//   exit;
// }

$service_id = $_SESSION['service_id'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>F&J Payment</title>


    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/F&J.png" />

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

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
        <!-- custom css file link  -->
    
   
    <link rel="stylesheet" href="css/payment.css" />
</head>
<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');
input, textarea, select {
      margin-bottom: 10px;
      border: 1px solid #b1afaf;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
	  color:#555;
      }
      select {
      width: 100%;
      padding: 7px 0;
      background: transparent;
      }

      textarea {
      width: calc(100% - 12px);
      padding: 5px;	  
      }
	  
      .item input:hover, .item select:hover, .item textarea:hover {
      	border: 1px solid transparent;
      	box-shadow: 0 0 6px 0 #333;
      	color: #333;
      }
      .item {
      	position: relative;
      	margin: 10px 0;
      }
	  .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      	position: absolute;
      	font-size: 20px;
      	color: #555;
      }
      .item i {
      	right: 1%;
      	top: 30px;
      	z-index: 1;
      }

      body{
        
      }


</style>
<body class="is-preload">

	<!-- Main -->
	<div id="main">
		<!-- Popup -->

			
      <div class="container">
      <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> </h4>

              <div class="row">
                <div class="col-md-12">
                
        
            
            <form method="POST" action="process-createPayment.php">
                <h2>F&J PAYMENT</h2>
                <div class="input-group">
                    <div class="input-box">
                                        <?php
                  $select_customer = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMERID = :custid");
                  oci_bind_by_name($select_customer, ':custid', $cust_id);
                  oci_execute($select_customer);

                  if ($row = oci_fetch_assoc($select_customer)) {
                ?>

                <input
                  type="hidden"
                  name = "custid"
                  value="<?php echo $row['CUSTOMERID']; ?>">
                      
                <div class="row">
                  <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Customer Name</label>
                    <input
                      type="text"
                      name = "name"
                      id="nameWithTitle"
                      class="form-control"
                      value="<?php echo $row['CUSTOMERNAME']; ?>" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Phone Number</label>
                    <input
                      type="text"
                      name = "phoneNum"
                      id="nameWithTitle"
                      class="form-control"
                      value="<?php echo $row['CUSTOMERPHONENUMBER']; ?>" readonly>
                  </div>
                </div>
                <?php }?>
                        <?php

                        // Display payment details from session
                        if (isset($_SESSION['payment_details'])) {
                            $payment_details = $_SESSION['payment_details'];

                            echo "<p>Total Payment: {$payment_details['totalPrice']}</p>";
                            echo "<p>Full Name: {$payment_details['customer_name']}</p>";
                            echo "<p>Phone Number: {$payment_details['phonenumber']}</p>";
                            echo "<p>Address: {$payment_details['address']}</p>";
                            echo "<p>Service Type: {$payment_details['type']}</p>";

                            // // Debug statement
                            // if (!empty($device_ids)) {
                            //     echo "Device IDs found in session: " . implode(', ', $device_ids);
                            // } else {
                            //     echo "<p>No devices found in session</p>";
                            // }

                            // Display device details
                            echo "<h3>Device Details:</h3>";
                            echo "<ul>";
                            // Use $device_ids only if it is set
                            if (!empty($device_ids)) {
                                // Inside the foreach loop where you execute the query
                                foreach ($device_ids as $device_id) {
                                    // // Debug statement
                                    // echo "Processing Device ID: $device_id";
                                    echo '<input type="hidden" id="device_id" name="device_id" value="' . $device_id . '">';

                                
                                    $select_device = oci_parse($conn, "SELECT * FROM DEVICE WHERE DEVICE_ID = :device_id");
                                    oci_bind_by_name($select_device, ":device_id", $device_id);
                                    $execute_result = oci_execute($select_device);
                                
                                    if (!$execute_result) {
                                        $error_message = oci_error($select_device)['message'];
                                        echo "Error executing query for Device ID: $device_id. Message: $error_message";
                                        exit;
                                    }
                                
                                    while ($row = oci_fetch_assoc($select_device)) {
                                        // Retrieve device details from the $row array
                                        $deviceType = isset($row['DEVICE_TYPE']) ? $row['DEVICE_TYPE'] : 'Not available';
                                        $deviceName = isset($row['DEVICE_NAME']) ? $row['DEVICE_NAME'] : 'Not available';
                                    
                                        echo "Device Type: {$deviceType}</br>";
                                        echo "Device Name: {$deviceName}</br>";
                                    }
                                    
                                }   
                                echo '<input type="hidden" id="customer_id" name="customer_id" value="' . $cust_id . '">';
                                echo '<input type="hidden" id="service_id" name="service_id" value="' . $service_id . '">';


                                

                            } else {
                                echo "<p>No devices found</p>";
                            }
                            echo "</ul>";
                        }
                        ?>
                        <h4>Payment Details</h4>
                        
                        <input type="radio" name="pay" id="bc1" checked class="radio" value="credit_card">
                        <label for="bc1"><span><i class="fa fa-cc-visa"></i> Credit Card</span></label>
                        <input type="radio" name="pay" id="bc2" class="radio" value="fpx">
                        <label for="bc2"><span><i class="fa fa-cc-bank"></i> FPX</span></label>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <button type="submit" name="submit">PAY NOW</button>
                    </div>
                </div>
            </form>
       
    </div>
    </div>   
    </div>
    </div>                                             




    <!-- Footer -->
	<div id="footer">

		<!-- Copyright -->
			<ul class="copyright">
				<li>&copy; F&J Multimedia. All rights reserved.</li><li> F&J Delivery</li>
			</ul>

	</div>

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>
      <script>
        function openCard() {
          
        }
                              
        function closeCard() {
          document.getElementById("myCard").style.display = "none";
        }
        
        document.addEventListener("DOMContentLoaded", function () {
            var radioButtons = document.querySelectorAll('input[name="pay"]');
            var paymentTypeInput = document.getElementById('payment_type');

            radioButtons.forEach(function (radio) {
            radio.addEventListener('change', function () {
                paymentTypeInput.value = this.value;
            });
            });
        });

      </script>
</body>
</html>
