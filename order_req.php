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

$AddSuccess = '';

if (isset($_SESSION['successAdd']) && $_SESSION['successAdd'] = true) {
  $AddSuccess = '<div style="color: green;">Service created successfully !</div>';
}
  unset($_SESSION['successAdd']);

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
				<div class="alert alert-success " role="alert">  <h4>Welcome, <?php echo $cust_name; ?> !</h4></div>
			
      

		<!-- Intro -->
		
			<div class="container">
			  <div class="row">
			  
                <div class="col-xl">
                  <div class="card mb-4">
			            
						  <form method ='POST' action ="process-createDevice.php">
                              <div class="modal-body">
							  
                              			  <form method ='POST' action ="process-createDevice.php">
                              <div class="modal-body">
							  	<!-- device -->
						<!-- device -->
						<?php
                        $select_customer = oci_parse($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = :cust_id");
                        oci_bind_by_name($select_customer, ':cust_id', $cust_id);
                        oci_execute($select_customer);

                        if ($row = oci_fetch_assoc($select_customer)) {
                        ?>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Customer Name</label>
                                    <input
                                      type="text"
                                      name = "name"
                                      id="nameWithTitle"
                                      class="form-control"
                                      value="<?php echo $row['CUSTOMER_NAME']; ?>" readonly>
                                  </div>
                                </div>
		  
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Phone Number</label>
                                    <input
                                      type="text"
                                      name = "name"
                                      id="nameWithTitle"
                                      class="form-control"
                                      value="<?php echo $row['CUSTOMER_PHONENUMBER']; ?>" readonly>
                                  </div>
                                </div>
									<?php }?>
								 <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Device Name</label>
                                    <select id="defaultSelect" class="form-select">
                                     <option>Select Device</option>
                                     <option value="1">Acer</option>
                                     <option value="2">HP</option>
                                     <option value="3">ENTAH</option>
									  </select>
									  
									  
									     <div class="col-sm-3">	
										  <i >
                                         <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAQ9JREFUSEu9lYkRwiAQRX860UrUTrQStRK1ErUStRLNywBDyMHGoDuTwRH4j2UPKv3Yqh
										 /rywJYS+JbufFZjzdJLzfye9DGAAtJJyc6pgFwI4mxY0OAg6T9hOtD/FKvZ1/L+gBTxWPBYwpJAVzLY8LJ06V4snOxaeZSwNVw5zk+kKVfFAO2Lqg5Acs8QW+yKwbMufsUGmIRA0hJvChhnB4vWh4QXIIcm6UQWf9O9oU4
										 xAIlAeHwMaBEBnlHzi5d/xtkGhpelDCKDS9aHlibW+4AIYP6Knluq0AzFFkfgP/mVHS22QHACyBT2jX7OuJDHvg7tsbkqwcnhgDi808mc4je5z6ZuWwxzVt7jUmsb9EHYikyGdeh6XQAAAAASUVORK5CYII="/>							 
										 </i>
										 
										  <i >
                                         <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAARhJREFUSEu9VYkRwjAMUzeBSYBNYBJgEmASYBJgEqh6Ts4JeRzakrteOJJIkWU7HWYe3cz
										 4sBCsAfBbyfzs5xuAl8z8nR0lggWAk4CWMEi4AcD5a+QIDgD2DeEj+KXfz3PBSBG0gmvAY0wSEzAsj4abx1upZCfeDGsxwbUSc7f/XbgESZZuXRNsxVRLUpQIeJ6mD9mlCSyxtyggrvdCEzAlqWIKBbw9VQQKaC5N1sNSiN
										 wfh8z7oAGmJPCX1wS1DNKKayafJV3/azIbGlVMYTKLjSoCBZbmZklTn0GpSh7bKoIiSxHwP0tF58JYbXY8SBUkaWnXQfVaC8niCbF+enDcJUjiPvdkOtD72CezkrG2ZWuvsaEldn0AiIU6GfK5k7kAAAAASUVORK5CYII="/>						 
										 </i>
                                        </div>
									  
									  
                                  </div>
                                </div>
								
								 <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Service Type</label>
                                    <select id="defaultSelect" class="form-select">
                                     <option>Select Service</option>
                                     <option value="1">One</option>
                                     <option value="2">Two</option>
                                     <option value="3">Three</option>
									  </select>
                                  </div>
                                </div>
								
								 <div class="row">
                                  <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Set Date</label>
                                    <input			
                                      type="date"
                                      id="date"
                                      name = "time" 
                                      class="form-control"
                                      placeholder="Select Date" />
                                  </div>
                                </div>
								
						       <div class="row">
                                  <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Set Time</label>
                                    <input			
                                      type="time"
                                      id="time"
                                      name = "time" 
                                      class="form-control"
                                      placeholder="Select Time" />
                                  </div>
                                </div>
								
								<div class="row">
                                  <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Location</label>
                                    <input			
                                      type="text"
                                      id="date"
                                      name = "time" 
                                      class="form-control"
                                      placeholder="Enter Location" />
                                  </div>
                                </div>
								
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" name="add" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
				<div id="popup" class="hidden">
   					 <p>Sorry, the selected delivery time is unavailable. Please choose another time.</p>
    				<button onclick="hidePopup()">OK</button>
  				</div>
                             
 			 <!-- The pop-up message container -->
 
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

		<script>
			// Function to show the pop-up
			function showPopup() {
				document.getElementById('popup').style.display = 'block';
			}
		
			// Function to hide the pop-up
			function hidePopup() {
				document.getElementById('popup').style.display = 'none';
			}
		
			// Function to check if the selected delivery time is unavailable
			function checkDeliveryTime() {
				var selectedTime = document.getElementById('time').value;
				var timeParts = selectedTime.split(":");
				var hours = parseInt(timeParts[0], 10);
		
				// Check if the selected time is between 6 PM (18:00) and 8 AM (08:00)
				if (hours >= 18 || hours < 8) {
				showPopup();
				}
			}

			
			// Get references to the checkboxes and the serviceFields container
			const deliverCheckbox = document.getElementById('deliver');
			const pickupCheckbox = document.getElementById('pickup');
			const serviceFields = document.getElementById('serviceFields');

			// Add event listeners to the checkboxes
			deliverCheckbox.addEventListener('change', toggleServiceFields);
			pickupCheckbox.addEventListener('change', toggleServiceFields);

			// Function to toggle visibility of delivery fields based on checkbox selection
			function toggleServiceFields() {
				if (deliverCheckbox.checked || pickupCheckbox.checked) {
					serviceFields.style.display = 'block';
				} else {
					serviceFields.style.display = 'none';
				}
			}
			

		
			// Add an event listener to trigger the check when the delivery time changes
			document.getElementById('time').addEventListener('change', checkDeliveryTime);
			// show device details
			function generateDeviceDetails() {
				const numDevices = parseInt(document.getElementById('deviceNum').value);
				let deviceDetailsHTML = '';
				for (let i = 1; i <= numDevices; i++) {
					deviceDetailsHTML += '<fieldset>';
					deviceDetailsHTML += '<legend>Device ' + i + ' Details</legend>';
					deviceDetailsHTML += '<label for="deviceType' + i + '">Device Type</label>';
					deviceDetailsHTML += '<input type="text" placeholder="Type of Device" id="deviceType' + i + '" name="deviceType' + i + '">';
					deviceDetailsHTML += '<label for="deviceName' + i + '">Device Name</label>';
					deviceDetailsHTML += '<input type="text" placeholder="Name of Device" id="deviceName' + i + '" name="deviceName' + i + '">';
					deviceDetailsHTML += '</fieldset>';
				}
				document.getElementById('dynamicDeviceDetails').innerHTML = deviceDetailsHTML;
		
			}
		</script>

		<script>
            function validateDate() {
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = String(currentDate.getMonth() + 1).padStart(2, '0');
                var day = String(currentDate.getDate()).padStart(2, '0');
                var formattedCurrentDate = year + '-' + month + '-' + day;

                var selectedDate = document.getElementById('date').value;
                
                if (selectedDate < formattedCurrentDate) {
                    alert("Please choose a date in the future.");
                    document.getElementById('date').value = "<?php echo $service_date_formatted; ?>"; // Reset the date input
                }
            }
		</script>
	</body>	
</html>