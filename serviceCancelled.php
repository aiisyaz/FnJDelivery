<!DOCTYPE HTML>
<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include('include/config.php');
include('sidebar_customer.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

if (!isset($cust_id)) {
  header('location: login/process.php');
  exit;
}

// message for edit

$updateSuccess = false;
$updateFailure = false;

// Check if update success or failure messages are set
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    $updateSuccess = true;
    unset($_SESSION['update_success']); // Reset the session variable
}

if (isset($_SESSION['update_failure']) && $_SESSION['update_failure']) {
    $updateFailure = true;
    unset($_SESSION['update_failure']); // Reset the session variable
}

// message for cancel
if (isset($_SESSION['CancelError'])) {
    $error_message = '';
    switch ($_SESSION['CancelError']) {
        case 1:
            $error_message = 'Service not found.';
            break;
        case 2:
            $error_message = 'Error occurred while cancelling the service.';
            break;
        case 3:
            $error_message = 'Service ID not provided.';
            break;
        default:
            $error_message = 'An unknown error occurred.';
            break;
    }
    echo '<div style="color: red;">Error: ' . $error_message . '</div>';
    unset($_SESSION['CancelError']); // Remove the error message from session
}

// Display success message if it exists
if (isset($_SESSION['CancelSuccess'])) {
    echo '<div style="color: green;">Service cancelled successfully.</div>';
    unset($_SESSION['CancelSuccess']); // Remove the success message from session
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
    body{
    
    }
    h5{
        text-align: center;
        font-size:15px;

    }
    .center{
        text-align: center;
    }

    h4{
        text-align: center;

    }
	table {
		width: 100%;
		text-align: left;
	}


		table td {
			padding: 0em 0em 0em 1.5em;
		}

		table th {
			text-align: left;
			padding: 0em 0em 0em 1.5em;
			color: #fff;
	
		}

		table thead {
			background: #444;
			color: #fff;
		}

		table tfoot {
			background: #eee;
		}

        .btn-primary:hover {
            color: #fff;
            background-color: #71dd37;
            border-color: #71dd37;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(105, 108, 255, 0.4)}

        .card-header{
        display: flex;
        justify-content: space-between;
        text-align: center;
        }

        .left-header {
            margin-right: 150px;
        }

        .right-header {
            margin-left: 100px;
        }

</style>
<body class="is-preload">

	<!-- Main -->
	<div id="main">

		<!-- Intro -->
		<!-- <section class="one dark cover"> -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
			
			
    <!-- Display update success message if set -->
    <?php if ($updateSuccess): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div style="color: green;">
                Service status updated successfully. 
                <button onclick="closeMessage()">Close</button>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Display update failure message if set -->
    <?php if ($updateFailure): ?>
        <div style="color: red;">
            Failed to update service status. 
            <button onclick="closeMessage()">Close</button>
        </div>
    <?php endif; ?>

	<!-- Main -->

              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tracking Service / Cancelled</span> </h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="btn btn-outline-secondary" href="serviceInComing.php"><i class="bx bx-pie-chart-alt me-1"></i> In Coming</a>
                    </li>
                    <li class="nav-item">
                      <a class="btn btn-outline-secondary" href="serviceInProgress.php"
                        ><i class="bx bx-pie-chart-alt me-1"></i> In Progress</a>
                    </li>
                    <li class="nav-item">
                      <a class="btn btn-outline-secondary" href="serviceComplete.php"
                        ><i class="bx bx-check-shield me-1"></i> Completed</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="serviceCancelled.php"
                        ><i class="bx bx-bell me-1"></i> Cancelled</a>
                    </li>
                  </ul>

                  
                    <form method='POST' action="process-cancelService.php">
                        <?php
                            $query = "SELECT
                            c.CUSTOMERNAME,
                            s.SERVICENAME,
                            DATE_FORMAT(sd.SERVICEDETAILSTIMESTAMP, '%d/%m/%Y') AS SERVICE_DATE,
                            DATE_FORMAT(sd.SERVICEDETAILSTIMESTAMP, '%H:%i:%s') AS SERVICE_TIME,
                            sd.SERVICEDETAILSID,
                            DATE_FORMAT(t.TRACKTIMESTAMP, '%d/%m/%Y %H:%i:%s') AS TRACKTIMESTAMP,
                            sd.SERVICEDETAILSLOCATION,
                            COALESCE(sd.SERVICEDETAILSINVOICENUM, '-') AS INVOICENUM,
                            t.TRACKSTATUS
                        FROM 
                            SERVICEDB.TRACKING t
                        JOIN 
                            SERVICEDB.SERVICEDETAILS sd ON t.SERVICEDETAILSID = sd.SERVICEDETAILSID
                        JOIN 
                            SERVICEDB.SERVICE s ON sd.SERVICEID = s.SERVICEID
                        JOIN 
                            SERVICEDB.CUSTOMER c ON sd.CUSTOMERID = c.CUSTOMERID
                        WHERE 
                            t.TRACKSTATUS = 'CANCELLED' AND sd.CUSTOMERID = '$cust_id'";

                            $select_service = mysqli_query($conn, $query);
                        
                            if (mysqli_num_rows($select_service) > 0) {

                                while ($fetch_service = mysqli_fetch_assoc($select_service)){
                        ?> 
                        
                        <div class="card mb-4"> 
                            <table> 
                                <tr>
                                <div class="card-header">
                                    <h4 class="left-header"><?php echo $fetch_service['TRACKSTATUS']; ?></h4>
                                    <h5 class="right-header"><?php echo $fetch_service['TRACKTIMESTAMP']; ?></h5>
                                </div>
                            
                            <div class="card-body">
                                 
                                <tr>
                                    <td><i class=""></i> <strong>Service ID</strong> </td>
                                    <td><?php echo $fetch_service['SERVICEDETAILSID']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class=""></i> <strong>Location </strong></td>
                                    <td><?php echo $fetch_service['SERVICEDETAILSLOCATION']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class=""></i> <strong>Type </strong></td>
                                    <td><?php echo $fetch_service['SERVICENAME']; ?></td>
                                    <td><input type="hidden" name="SERVICE_ID" value="<?php echo $fetch_service['SERVICEDETAILSID']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="demo-inline-spacing">
                                        <a type= "button" class ="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalStatus<?php echo $fetch_service['SERVICEDETAILSID']; ?>">Details</a>
                                        
                                        </p> 
                                            <!-- Modal 2 -->
                                            <?php
                                                $service_id = $fetch_service['SERVICEDETAILSID'];
                                                // Select service status data
                                                $query = "SELECT DISTINCT d.DEVICETYPE, d.DEVICENAME, d.DEVICEID, d.DEVICEDESC
                                                FROM SERVICE s
                                                JOIN
                                                    SERVICEDETAILS sd ON s.SERVICEID = sd.SERVICEID
                                                JOIN 
                                                    SERVICEDETAILSDEVICE sdv ON sd.SERVICEDETAILSID = sdv.SERVICEDETAILSID
                                                JOIN
                                                    DEVICE d ON sdv.DEVICEID = d.DEVICEID 
                                                    WHERE sdv.SERVICEDETAILSID = '$service_id'";

                                                $fetch_track = mysqli_query($conn, $query);
                                 

                                                // Check if query execution is successful
                                                if ($fetch_track) {
                                            ?>
                                            <div class="modal fade" id="modalStatus<?php echo $service_id; ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        
                                                        <h5 class="modal-title" id="modalCenterTitle">Service ID: <?php echo $fetch_service['SERVICEDETAILSID']; ?></h5> <br>

                                                        
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb">
                                                        <h4 class="modal-title"><?php echo $fetch_service['TRACKSTATUS']; ?></h4>
                                                        <table>
                                                        
                                                        <tr>
                                                            <td><i class=""></i> <strong>Service Time</strong> </td>
                                                            <td><?php echo $fetch_service['SERVICE_TIME']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class=""></i> <strong>Service Date</strong> </td>
                                                            <td><?php echo $fetch_service['SERVICE_DATE']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center;">-------------------</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:left"><h5 class="card-header"><strong>DEVICE DETAILS</strong></td>
                                                        </tr>
                                                    <?php
                                                    // Fetch data from the result set
                                                    while ($device = mysqli_fetch_assoc($fetch_track)) {
                                                        ?>
                                                        <tr>
                                                            <td><i class=""></i> <strong>Device ID </strong></td>
                                                            <td><?php echo $device['DEVICEID']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class=""></i> <strong>Device Name &nbsp; </strong></td>
                                                            <td><?php echo $device['DEVICENAME']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class=""></i> <strong>Device Type </strong></td>
                                                            <td><?php echo $device['DEVICETYPE']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class=""></i> <strong>Device Description </strong></td>
                                                            <td><?php echo $device['DEVICEDESC']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center;">-------------------</td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <!-- END MODAL --> 
                                    </td>
                                   
                                </tr>
                                  
                            </div>  
                                </table>
                            
                        </div>
                        <?php
                            } 
        
                            } else {
                            echo '<p>No Service Found.</p>';
                            }
                        ?> 
                    </form>
                            <!-- /Account -->
                    </div>
                        <!-- <div class="card">
                            <h5 class="card-header">Delete Account</h5>
                            <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                                </div>
                            </div>
                            <form id="formAccountDeactivation" onsubmit="return false">
                                <div class="form-check mb-3">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation"
                                    >I confirm my account deactivation</label
                                >
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                            </form>
                            </div>
                        </div> -->
                        <!-- end acc delete -->
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- History -->
            <!-- <section id="portfolio" class="two">
                <div class="container">

                    <header>
                        <h2>Order History</h2>
                    </header>

                    <p>You have no order history .</p>

                </div>
            </section> -->
    </div>



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
        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../assets/vendor/js/menu.js"></script>

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
		
			
		</script>
        <script>

            function getService(SERVICE_ID) {
            // Using AJAX to send the customer ID to the server
            var xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Parse the JSON response
                    var serviceData = JSON.parse(xhr.responseText);
                    
                    // Redirect to the display page with the customer data
                    window.location.href = 'editServiceDetails.php' +
                    '?SERVICE_ID=' + encodeURIComponent(serviceData.SERVICE_ID) +
                    '&CUSTOMER_NAME=' + encodeURIComponent(serviceData.CUSTOMER_NAME) +
                    '&SERVICE_TYPE=' + encodeURIComponent(serviceData.SERVICE_TYPE) +
                    '&SERVICE_LOCATION=' + encodeURIComponent(serviceData.SERVICE_LOCATION) +
                    '&SERVICE_TIME=' + encodeURIComponent(serviceData.SERVICE_TIME) +
                    '&SERVICE_DATE=' + encodeURIComponent(serviceData.SERVICE_DATE) +
                    '&SERVICE_TOTDEVICE=' + encodeURIComponent(serviceData.SERVICE_TOTDEVICE);
                } else {
                    // Handle the error, log or show a message
                    console.error('Error fetching customer service data:', xhr.status, xhr.statusText);
                }
                }
            };

            xhr.open('POST', 'process-getService.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('SERVICE_ID=' + encodeURIComponent(SERVICE_ID));
            }

        </script>

        <script>
            function closeMessage() {
                // Remove the message element
                document.querySelector('.message').remove();
            }
        </script>
            <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
	</body>	
</html>