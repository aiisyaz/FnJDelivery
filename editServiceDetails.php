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

    // Retrieve customer details from the URL parameters
    $service_id = isset($_GET['SERVICEDETAILSID']) ? $_GET['SERVICEDETAILSID'] : '';
    $custName = isset($_GET['CUSTOMERNAME']) ? $_GET['CUSTOMERNAME'] : '';
    $serviceType = isset($_GET['SERVICENAME']) ? $_GET['SERVICENAME'] : '';
    $service_time = isset($_GET['SERVICE_TIME']) ? $_GET['SERVICE_TIME'] : '';
    $service_date = isset($_GET['SERVICE_DATE']) ? $_GET['SERVICE_DATE'] : '';
    $serviceLocation = isset($_GET['SERVICEDETAILSLOCATION']) ? $_GET['SERVICEDETAILSLOCATION'] : '';

    // create date and time format for validation
    $service_date_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $service_date)));
  
    $service_time_formatted = date('H:i', strtotime($service_time));

    // Fetch SERVICE information based on the provided ID
    if ($service_id) {
        $query = "SELECT 
            c.CUSTOMERID,
            c.CUSTOMERNAME,
            c.CUSTOMERPHONENUMBER,
            s.SERVICENAME,
            DATE_FORMAT(sd.SERVICEDETAILSTIMESTAMP, '%d/%m/%Y') AS SERVICE_DATE,
            DATE_FORMAT(sd.SERVICEDETAILSTIMESTAMP, '%H:%i:%s') AS SERVICE_TIME,
            COALESCE(sd.SERVICEDETAILSINVOICENUM, '-') AS INVOICENUM,
            sd.SERVICEDETAILSID,
            sd.SERVICEDETAILSTIMESTAMP,
            sd.SERVICEDETAILSLOCATION,
            sd.SERVICEDETAILSINVOICENUM,
            t.TRACKSTATUS
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
        JOIN 
            TRACKING t ON sd.SERVICEDETAILSID = t.SERVICEDETAILSID 
        WHERE sd.SERVICEDETAILSID = '$service_id'";

        $stmt = mysqli_query($conn, $query);

        if ($stmt) {
            $serviceData = mysqli_fetch_assoc($stmt);
            // Process and display the service data as needed
        } else {
            echo "Error: " . mysqli_error($conn);
        }
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

	<!-- Main -->
	<div id="main">

          <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">In Coming/</span> Edit Service</h4>

                <!-- Basic Layout & Basic with Icons -->
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="modal-body">
                                <form action="process-editService.php" method="POST">
                                    <div class="form-group mb-3">
                                        <label>Service ID:</label>
                                        <input type="text" name="id" id="service_id" value="<?php echo $service_id; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Service Type:</label>
                                        <input type="text" name="type" id="type" value="<?php echo $serviceType; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="item">  
                                            <label>Service Time:</label>
                                            <input type="time" name="time" id="time" value="<?php echo $service_time; ?>" onchange="checkDeliveryTime()" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Service Date:</label>
                                        <input type="date" name="date" id="date" value="<?php echo $service_date_formatted; ?>" onchange="validateDate()" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Service Location:</label>
                                        <input type="text" name="location" id="location" value="<?php echo $serviceLocation; ?>" class="form-control">
                                    </div>
                                    <script>

                                    </script>

                                    <div class="modal-footer">
                                        <input class="btn btn-primary btn-sm" type="submit" name="update" value="Update">
                                        <a type="button" class="btn btn-secondary btn-sm" href="serviceInComing.php" >Close</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
              
        <!-- / Content -->

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

            document.getElementById('time').addEventListener('change', checkDeliveryTime);
		
			// Function to check if the selected delivery time is unavailable
            function checkDeliveryTime() {
                var selectedTime = document.getElementById('time').value;
                var timeParts = selectedTime.split(":");
                var hours = parseInt(timeParts[0], 10);

                // Check if the selected time is between 6 PM (18:00) and 8 AM (08:00)
                if (hours >= 18 || hours < 8) {
                    // Display a message or perform necessary actions
                    alert("The selected delivery time is unavailable. Please choose between 6PM until 8AM. ");
                    document.getElementById('time').value = "<?php echo $service_time_formatted; ?>";
                  
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