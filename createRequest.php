<!DOCTYPE HTML>
<?php

session_start();

include('include/config.php');
include('sidebar_customer.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

if (!isset($cust_id)) {
  header('location: login/process.php');
  exit;
}

$AddSuccess = '';

if (isset($_SESSION['successAdd']) && $_SESSION['successAdd'] = true) {
  $AddSuccess = '<div style="color: green;">Service created successfully !</div>';
}
  unset($_SESSION['successAdd']);

  $selectQuery = "SELECT * FROM SERVICE ORDER BY SERVICEID";
  $result = mysqli_query($conn, $selectQuery);
  if($result){

    // Initialize service prices
    $servicePrice1 = null;
    $servicePrice2 = null;

    if ($priceRow = mysqli_fetch_assoc($result)) {
        $servicePrice1 = $priceRow['SERVICEPRICE'];
    }
    if ($priceRow = mysqli_fetch_assoc($result)) {
        $servicePrice2 = $priceRow['SERVICEPRICE'];
    }
  } else {
    echo "Error: " . mysqli_error($conn);
  }
  

      // Assume you have a PHP variable $servicePrice holding the value you want to transfer to JavaScript
      // Example value

      // Echo the value into a JavaScript variable
      echo "<script>";
      echo "var servicePrice1 = " . json_encode($servicePrice1) . ";"; // Using json_encode to handle data types properly
      echo "var servicePrice2 = " . json_encode($servicePrice2) . ";"; // Using json_encode to handle data types properly
      echo "</script>";

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
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/js/config.js"></script>

<style>

    .selected-option {
        color: gray;
    }

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
      .item i {
      	right: 1%;
      	top: 30px;
      	z-index: 1;
      }
/* Styles for the pop-up container */
    #popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Hide the pop-up initially */
    .hidden {
      display: none;
	  color: black;
	  border-radius: 1rem;
	  border:#02ff5b;
	  border-color: #02ff5b;
    }
</style>

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
    <div class="alert alert-success " role="alert">  <h4>Welcome, <?php echo $cust_name; ?> !</h4></div>
			
      

		<!-- Intro -->
		
    <div class="container">
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">		            
            <form method ='POST' action ="process-createService.php" onsubmit="return validateForm()">
              <div class="modal-body">

                <?php
                  // Escape the customer ID to prevent SQL injection
                  $cust_id_escaped = mysqli_real_escape_string($conn, $cust_id);

                  $select_customer = mysqli_query($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMERID = '$cust_id_escaped'");

                  if ($row = mysqli_fetch_assoc($select_customer)) {
                ?>

                <input
                  type="hidden"
                  name = "cust_id"
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

                <div class="row">
                  <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">Service Type</label>
                    <select id="defaultSelect" name="serviceType" class="form-select" onchange="handleServiceChange()" required>
                      <option selected disabled value="">Select Service Type</option>
                      <?php
                        $query3 = "SELECT * FROM SERVICE";
                        $stid3 = mysqli_query($conn, $query3);

                        if (!$stid3) {
                            die("Error fetching service data: " . mysqli_error($conn));
                        }

                        while ($row3 = mysqli_fetch_assoc($stid3)) {
                            echo "<option value='" . $row3['SERVICEID'] . "'>" . $row3['SERVICENAME'] . "</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label for="priceWithTitle" class="form-label">Service Price (RM)</label>
                    <input			
                      type="text"
                      id="price"
                      name = "price" 
                      class="form-control"
                      readonly/>
                  </div>
                </div> 
              
                <div class="row">
                  <div class="col mb-3">
                    <label for="date" class="form-label">Set Date</label>
                    <input type="date" id="date" name="date" class="form-control" placeholder="Select Date" onchange="validateDate()" required/>

                  </div>
                </div>
              
                <div class="row">
                  <div class="col mb-3">
                    <div class="item">  
                      <label for="time" class="form-label">Set Time</label>
                      <input type="time" id="time" name="time" class="form-control" placeholder="Select Time" onchange="checkDeliveryTime()" required/>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col mb-3">
                    <label for="addressWithTitle" class="form-label">Address</label>
                    <input			
                      type="text"
                      id="address"
                      name = "address" 
                      class="form-control"
                      placeholder="Enter Address" 
                      required/>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label for="nameWithTitle" class="form-label">City</label>
                    <select name ="city" id="city" class="form-select" required>
                      <option selected disabled value="">Choose</option>
                        <?php
                            $query2 = "SELECT * FROM CITY ";
                            $stid2 = mysqli_query($conn, $query2);
                            
                            while ($row2 = mysqli_fetch_assoc($stid2)) {
                                echo "<option value='" . $row2['CITYID'] . "'>" . $row2['CITYNAME'] . "</option>";
                            }
                        ?>
                    </select>
                  </div>
                </div>                

                <div class="row">
                  <div class="col mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" 
                      id="state"
                      name = "state" 
                      class="form-control"
                      placeholder="Enter State" 
                      required/>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label for="invoiceWithTitle" class="form-label">Invoice Number</label>
                    <input			
                      type="text"
                      id="invoice"
                      name = "invoice" 
                      class="form-control"
                      placeholder="Enter invoice number" 
                      disable />
                  </div>
                </div>              

                <div class="row">
                  <div class="col-md-6 col-12 mb-md-0 mb-4">
                    <div class="col mb-3">
                      <label for="Device" class="form-label">Device Infrmation</label>
                      <p>Select your device</p>
                      <div class="col-sm-14 service-container d-flex align-items-center">
                        <?php
                          $query4 = "SELECT * FROM DEVICE WHERE CUSTOMERID = '$cust_id' AND DEVICESTATUS ='ACTIVE' ";
                          $stid4 = mysqli_query($conn, $query4);

                          while ($row4 = mysqli_fetch_assoc($stid4)) {
                        ?>
                        <div class="card-body">   
                          <!-- Connections -->   
                          <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                              <h6 class="mb-0"><?php echo $row4['DEVICEID'] ?></h6>
                              <small class="text-muted"><?php echo $row4['DEVICENAME'] ?></small>
                            </div>
                            <div class="col-3 text-end">
                              <div class="form-check form-switch">
                                
                                <input type="checkbox" class="form-check-input float-end" id="selectService" role="switch" name="selectService[]" value="<?php echo $row4['DEVICEID']; ?>"/>
                              </div>
                            </div>
                            
                          </div>
                          
                        
                            
                          <!-- /Connections -->
                        </div>
                          
                      </div>
                        <?php } ?>
                        
                    </div>
                  </div>
                  <label>Don't have device? <a href="view_device.php" style="color:#07f757;">Add your device</a></label>
                </div>

                <div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
            <div id="popup" class="hidden">
              <p>Sorry, the selected delivery time is unavailable. Please choose another time.</p>
              <button class ="btn btn-primary" onclick="hidePopup()">OK</button>
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

    <script>
      function validateForm() {
        // Get the input date and time values
        const inputDate = document.getElementById('date').value;
        const inputTime = document.getElementById('time').value;

        const inputDateTime = new Date(`${inputDate}T${inputTime}`);
        const now = new Date();

        if (inputDateTime < now) {
            alert('The selected date and time cannot be in the past.');
            return false; // Prevent form submission
        }

        // Get the address and invoice input fields
        var address = document.getElementById('address').value.trim();
        var state = document.getElementById('state').value.trim();
        var invoice = document.getElementById('invoice').value.trim();

        // Validate address length
        if (address.length > 75) {
            alert("Address is too long.");
            return false;
        }

        if (state.length > 15) {
            alert("state is too long.");
            return false;
        }

        // Validate invoice length
        if (invoice.length > 29) {
            alert("invoice is too long, please insert the correct invoice.");
            return false;
        }

        // Get all checkboxes with name "selectService[]"
        var checkboxes = document.querySelectorAll('input[name="selectService[]"]');
        
        var checked = false; // Initialize a variable to track if at least one checkbox is checked
        
        // Check if at least one checkbox is checked
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked = true; // Set checked to true if at least one checkbox is checked
                break; // Exit the loop early since we found a checked checkbox
            }
        }

        // If no checkbox is checked, display an error message and prevent form submission
        if (!checked) {
            alert("Please select at least one device.");
            return false;
        }

        // If we reach this point, all validations passed and at least one checkbox is checked, so allow form submission
        return true;
      }
    </script>


    <script>
    var selectedDevices = []; // Array to store selected device IDs

    function disableSelectedOptions() {
        var selectElement = document.getElementById("selectService");
        var selectedOption = selectElement.value;

        // Add the selected device ID to the array
        if (!selectedDevices.includes(selectedOption)) {
            selectedDevices.push(selectedOption);
        }

        var options = selectElement.getElementsByTagName("option");

        // Disable all options that have been selected
        for (var i = 0; i < options.length; i++) {
            if (selectedDevices.includes(options[i].value)) {
                options[i].disabled = true;
            } else {
                options[i].disabled = false;
            }
        }
    }
</script>
    <script>
  $(document).ready(function() {
    // Counter to keep track of the number of service and item elements
     var serviceCounter = 1;

    // Click event for adding another service
    $(document).on("click", ".add-service-btn", function() {
        // Clone the existing service container
        var newService = $(this).closest('.card').find('.service-container:first').clone();

        // Increment the counter and update the data attribute
        serviceCounter++;
        newService.attr("data-service-id", serviceCounter);

        // Update IDs and names to make them unique
        newService.find("select").attr("name", "selectService[]");
        newService.find("select").val(""); // Clear the selected option

        // Append the cloned service container to the form
        $(this).closest('.card').find('.service-container:last').after(newService);
    });

    // Function to remove a service
    $(document).on("click", ".remove-service-btn", function() {
        if ($(this).closest('.service-container').attr("data-service-id") !== "1") {
            $(this).closest('.service-container').remove();
        }
    });

});

  </script>
		<!-- Scripts -->
		<script src="js/form.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollex.min.js"></script>
		<script src="js/browser.min.js"></script>
		<script src="js/breakpoints.min.js"></script>
		<script src="js/util.js"></script>
		<script src="js/main.js"></script>

		<script>
			// Function to show the pop-up
			function showPopup() {
				document.getElementById('popup').style.display = 'block';
			}
		
			// Function to hide the pop-up
			function hidePopup() {
				document.getElementById('popup').style.display = 'none';
			}
			
			// to check time inserted
			document.getElementById('time').addEventListener('change', checkDeliveryTime);
			// show device details
			// Function to check if the selected delivery time is valid
      function checkDeliveryTime() {
          var selectedTime = document.getElementById('time').value;
          var timeParts = selectedTime.split(":");
          var hours = parseInt(timeParts[0], 10);

          // Check if the selected time is between 6 PM (18:00) and 8 AM (08:00)
          if (hours >= 18 || hours < 8) {
              // Display a message or perform necessary actions
              alert("The selected delivery time is unavailable. Please choose another time.");
              document.getElementById('time').value = ""; // Reset the date input
          }
      }
  
		</script>
    
<!-- to disable invoice number input -->

    <!-- JS for check past date -->
		<script>
			function validateDate() {
				var currentDate = new Date().toISOString().split('T')[0];
				var selectedDate = document.getElementById('date').value;

				if (selectedDate < currentDate) {
					alert("Error select past date. Please choose another date.");
					document.getElementById('date').value = ""; // Reset the date input
				}
			}
		</script>

    <!-- fetch service price -->
    <script>
    function handleServiceChange() {
    // Get the selected service type
    var selectedServiceId = document.getElementById('defaultSelect').value;

    // Call the function to get the service price
    getServicePrice(selectedServiceId);

    // Call the function to toggle the invoice input based on service type
    toggleInvoiceInput(selectedServiceId);
    }

    function getServicePrice(serviceId) {
            // Send an AJAX request to fetch the service price based on service ID
            fetch('process-getPrice.php?serviceId=' + serviceId)
                .then(response => response.json())
                .then(data => {
                    if (data.price) {
                        // Update the price input field with the fetched price
                        document.getElementById('price').value = data.price;

                        // Display the service price in the HTML
                        document.getElementById('priceDisplay').innerHTML = 'Service Price: $' + data.price;
                    } else {
                        // If price is not found, display an error message
                        document.getElementById('price').value = 'Price not found';
                        document.getElementById('priceDisplay').innerHTML = 'Service Price: Price not found';
                    }
                })
                .catch(error => {
                    console.error('Error fetching service price:', error);
                });
        }


        function toggleInvoiceInput(serviceId, servicePrice) {
          // Toggle the visibility of the invoice input based on service type
          var invoiceInput = document.getElementById('invoice');
          var priceInput = document.getElementById('price');
          if (serviceId === 'S100') { // Assuming 'S01' represents delivery
              invoiceInput.disabled = false; // Enable invoice input for delivery
              priceInput.value = <?php echo $servicePrice1;?>; // Set service price value
          } else if (serviceId === 'S200') { // Assuming 'S02' represents pickup
              invoiceInput.disabled = true; // Disable invoice input for pickup
              invoiceInput.value = ''; // Clear the invoice input value
              priceInput.value = <?php echo $servicePrice2;?>; 
          } else {
              // Hide the invoice input if no service type is selected
              invoiceInput.disabled = true;
              invoiceInput.value = ''; // Clear the invoice input value
              priceInput.value = ''; // Clear the price input value
          }
        }

    </script>

	</body>	
</html>