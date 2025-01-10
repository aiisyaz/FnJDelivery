
<!DOCTYPE HTML>
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
        <!-- <script>

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

        </script> -->
	</body>	
</html>