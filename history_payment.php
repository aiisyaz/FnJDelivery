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



</head>
<style>

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

	
      .checkbox {
        width: 45px;
        height: 15px;
        background: #555;
        margin: 20px 10px;
        position: relative;
        border-radius: 5px;
      }
      .checkbox label {
        display: block;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        transition: all .5s ease;
        cursor: pointer;
        position: absolute;
        top: -2px;
        left: -3px;
        background: #02ff5b;
      }
      .checkbox input[type=checkbox]:checked + label {
        left: 27px;
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
<body class="is-preload">

	<!-- Header -->
	<div id="header">

		<div class="top">

			<!-- Logo -->
			<div id="logo">
				<span class="image avatar48"><img src="image/F&J noBG.png" alt="" /></span>
				<h1 id="title">F&J Delivery</h1>
				<p>Global Digital</p>
			</div>

<body class="is-preload">

	<!-- Main -->
	<div id="main">

		<!-- Intro -->
		<!-- <section class="one dark cover"> -->
        <div class="content-wrapper">
            <!-- Content -->
	 <h1>My Devices List</h1>
		 <!-- Bootstrap modals -->
             
               
                <div class="card-body">
                 
		                    <!-- Vertically Centered Modal -->
                    <div class="col-lg-4 col-md-6">
                  
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button
                          type="button"
                          class="btn rounded-pill btn-success"
                          data-bs-toggle="modal"
                          data-bs-target="#modalCenter">
                          Add New Device
                        </button>
                 
                      </div>
					  
					  
                    </div>
			<div class="container">
			  <div class="row">
                 <div class="col-md-6 col-lg-4">
                  <div class="card text-center mb-3">
                    <div class="card-body">
                      <h5 class="card-title">Device: ID001</h5>
                      <p class="card-text"> Device Detail</p>
					     <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#EditCenter">
                          Edit
                        </button>
					  <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
		      </div>
    	   </div>
		     </div>
            
		
	
		

       </div>
	</div> <!-- End Main -->

                   <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Add Device</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Name</label>
                                    <input
                                      type="text"
                                      id="nameWithTitle"
                                      class="form-control"
                                      placeholder="Enter Name" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">Email</label>
                                    <input
                                      type="email"
                                      id="emailWithTitle"
                                      class="form-control"
                                      placeholder="xxxx@xxx.xx" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">DOB</label>
                                    <input type="date" id="dobWithTitle" class="form-control" />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
						
						<!--Edit Modal -->
                        <div class="modal fade" id="EditCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Edit Device</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Name</label>
                                    <input
                                      type="text"
                                      id="nameWithTitle"
                                      class="form-control"
                                      placeholder="Enter Name" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">Email</label>
                                    <input
                                      type="email"
                                      id="emailWithTitle"
                                      class="form-control"
                                      placeholder="xxxx@xxx.xx" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">DOB</label>
                                    <input type="date" id="dobWithTitle" class="form-control" />
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>

		<!-- Footer -->
		<div id="footer">

			<!-- Copyright -->
				<ul class="copyright">
					<li>&copy; 2023. All rights reserved.</li><li> F&J Delivery</li>
				</ul>

		</div>
			

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
				var currentDate = new Date().toISOString().split('T')[0];
				var selectedDate = document.getElementById('date').value;

				if (selectedDate < currentDate) {
					alert("Please choose a date in the future.");
					document.getElementById('date').value = ""; // Reset the date input
				}
			}
		</script>
		
		    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/ui-modals.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
	</body>	
</html>