
<!DOCTYPE HTML>
<?php
session_start();

include('include/config.php');
include('sidebar_customer.php');


$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

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

    <!-- Display update success message if set -->
    <?php if ($updateSuccess): ?>
        <div style="color: green;">
            Service status updated successfully. 
            <button onclick="closeMessage()">Close</button>
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
	<div id="main">

		<!-- Intro -->
		<!-- <section class="one dark cover"> -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> </h4>

                <div class="row">
                    <div class="col-md-12">
            
                        <div class="card">
                             <div class="card-body">
                        <!--Edit Modal -->
                        <?php
                        
                            // Fetch device data only if the edit button is clicked
                            if (isset($_POST['edit'])) {
                                $device_id = $_POST['DEVICE_ID'];
                                // Select device data
                                $query = "SELECT * FROM DEVICE WHERE DEVICEID = '$device_id'";
                                $fetch_device_result = mysqli_query($conn, $query);
                            
                                // Fetch the device data as an associative array
                                $fetch_device = mysqli_fetch_assoc($fetch_device_result);
                                // Check if query execution is successful and data is fetched
                                    if ($fetch_device) {
                            
                        ?>
                                <form method='POST' action="process-editDevice.php" onsubmit="return validateForm()">
                                    <h5 class="modal-title">Edit Device</h5>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameWithTitle" class="form-label">Device ID</label>
                                                <input type="text" name="DEVICE_ID" class="form-control" value="<?php echo $fetch_device['DEVICEID']; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameWithTitle" class="form-label">Device Name</label>
                                                <input id="name" type="text" name="name" class="form-control" value="<?php echo $fetch_device['DEVICENAME']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="type" class="form-label">Device Type</label>
                                                <input id="type" type="text" name="type" class="form-control" value="<?php echo $fetch_device['DEVICETYPE']; ?>" />
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="type" class="form-label">Device Description</label>
                                                <input id="description" type="text" name="desc" class="form-control" value="<?php echo $fetch_device['DEVICEDESC']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="window.location.href='view_device.php'" class="btn btn-outline-secondary">Close</button>

                                        <button type="submit" name="edit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                <?php
                            } else {
                                echo "Device not found or error occurred while fetching data.";
                            }
                        }
                        ?>       

                    </div>
                    </div>
                    </div>
                    
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
		<footer class="content-footer footer bg-footer-theme">
			<!-- Copyright -->
			<p style="text-align:center;">&copy; 2024. All rights reserved.</p>
			<p style="text-align:center;"> F&J Delivery</p>
        </footer>


			

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
            function validateForm() {
                var deviceName = document.getElementById("name").value;
                var deviceType = document.getElementById("type").value;
                var deviceDesc = document.getElementById("description").value;

                var maxNameLength = 20;
                var maxTypeLength = 50; 
                var maxDescLength = 50; 

                if (deviceName.length > maxNameLength) {
                    alert("Device name cannot exceed " + maxNameLength + " characters.");
                    return false;
                }

                if (deviceType.length > maxTypeLength) {
                    alert("Device type cannot exceed " + maxTypeLength + " characters.");
                    return false;
                }

                if (deviceDesc.length > maxDescLength) {
                    alert("Device description cannot exceed " + maxDescLength + " characters.");
                    return false;
                }

                return true; // Form submission will proceed if all validations pass
            }
        </script>
        <script>
            function closeMessage() {
                // Remove the message element
                document.querySelector('.message').remove();
            }
        </script>
	</body>	
</html>