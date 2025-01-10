
<?php

// Initialize session
session_start();

// Include database connection settings
include('include/dbconnection.php');

// Retrieve session variables securely
$cust_id = $_SESSION['cust_id'];
$service_id = $_SESSION['service_id'];
$track_id = $_SESSION['track_id'];

// Query for device details
$queryTrack = "SELECT DISTINCT T.TRACK_ID, T.TRACK_STATUS, S.SERVICE_ID, S.SERVICE_TYPE, S.SERVICE_LOCATION, D.DEVICE_TYPE, D.DEVICE_NAME, C.CUSTOMER_NAME, R.RIDER_NAME, R.RIDER_PHONENUMBER,
                TO_CHAR(T.TRACK_TIMESTAMP, 'DD/MM/YYYY') AS TRACK_DATE,
                TO_CHAR(T.TRACK_TIMESTAMP, 'HH24:MI:SS') AS TRACK_TIME
                FROM TRACKSERVICE T
                JOIN DEVICE D ON T.DEVICE_ID = D.DEVICE_ID
                JOIN SERVICE S ON T.SERVICE_ID = S.SERVICE_ID
                JOIN CUSTOMER C ON T.CUSTOMER_ID = C.CUSTOMER_ID
                LEFT JOIN RIDER R ON T.RIDER_ID = R.RIDER_ID
                WHERE T.CUSTOMER_ID= '$cust_id' AND S.SERVICE_ID = :service_id";

$stmtTrack = oci_parse($conn, $queryTrack);

// Bind parameters

oci_bind_by_name($stmtTrack, ":service_id", $service_id);

// Execute the statement
oci_execute($stmtTrack);
?>

<!DOCTYPE HTML>

<html>
<head>
	<title>F&J Multimedia</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="css/sidebar.css" />
</head>
<style>
td, th {
    background-color: black;
    color: white; /* Adjust text color as needed */
}
table {
    border: 1px solid #02ff5b; /* Adjust border style as desired */
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

        a {
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #02ff5b;
            color: #02ff5b;
            border-radius: 3px;
            margin-right: 5px;
            display: inline-block;
            text-align: center;
        }

        a:hover {
            background-color: #02ff5b;
            color: #000;
            
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
			<!-- Nav -->
			<nav id="nav">
				<ul>
				<li><a href="order_req.php" id="top-link"><span class="icon solid fa-home">Order</span></a></li>
					<li><a href="showProfile.php" id="portfolio-link"><span class="icon solid fa-user">Profile</span></a></li>
					<li><a href="status_service.php" id="portfolio-link"><span class="icon solid fa-th">Status Tracking</span></a></li>
					<li><a href="about.html" id="contact-link"><span class="icon solid fa-th">About</span></a></li>
					<li><a href="login/logout.php" ><span class="fa-sign-out">Logout</span></a></li>
				</ul>
			</nav>
		</div>

		<div class="bottom">
			<!-- Social Icons -->
			<ul class="icons">
				<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
				<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
				<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
			</ul>
		</div>
	</div>

	<!-- Main -->
	<div id="main">
		<!-- Intro -->
        <section id="top" class="one dark cover">
            <div class="container">
                <form method='POST'>
                <header>
                    <h2>Service Status</h2>
                </header>
                <h3>Your Service Status:</h3>

                <?php
                while ($fetch_track = oci_fetch_assoc($stmtTrack)) {
                ?>
                    <table class="table table-bordered">
                        <tr>
                            <td>Service Type</td>
                            <td><?php echo $fetch_track['SERVICE_TYPE']; ?></td>
                        </tr>
                        <tr>
                            <td>Service Location</td>
                            <td><?php echo $fetch_track['SERVICE_LOCATION']; ?></td>
                        </tr>
                        <tr>
                            <td>Device Type</td>
                            <td><?php echo $fetch_track['DEVICE_TYPE']; ?></td>
                        </tr>
                        <tr>
                            <td>Device Name</td>
                            <td><?php echo $fetch_track['DEVICE_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td><?php echo $fetch_track['CUSTOMER_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><strong><?php echo $fetch_track['TRACK_STATUS']; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><?php echo $fetch_track['TRACK_DATE']; ?></td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td><?php echo $fetch_track['TRACK_TIME']; ?></td>
                        </tr>
                        <tr>
                            <td>Rider Name</td>
                            <td><?php echo $fetch_track['RIDER_NAME']; ?></td>
                        </tr>
                        <tr>
                            <td>Rider Phone Number</td>
                            <td><?php echo $fetch_track['RIDER_PHONENUMBER']; ?></td>

                        </tr>
                        <tr>
                            <td>Action</td> 
                            <td>
                            <a href="process-cancelService.php?delete=<?php echo $fetch_track['TRACK_ID']; ?>" onclick="return confirm('Are you sure you want to cancel this service?')">Delete</a>
                                <a  onclick="getService('<?php echo $service_ID; ?>')">Edit</a>
                            </td>
                        </tr> 
                    </table>
                <?php
                }
                ?>
                </form>

            </div>
        </section>


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
	</body>	
</html>
<?php

// Free and close the statement
oci_free_statement($stmtTrack);

// Close the database connection
oci_close($conn);
?>
