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



// Check for delete success or failure messages
$deleteSuccessMessage = '';
$deleteErrorMessage = '';

if (isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] == 1) {
    $deleteSuccessMessage = '<div style="color: green;">Device deleted successfully!</div>';
} elseif (isset($_SESSION['deleteError']) && $_SESSION['deleteError'] == 1) {
    $deleteErrorMessage = '<div style="color: red;">Device not found for deletion.</div>';
} elseif (isset($_SESSION['deleteError']) && $_SESSION['deleteError'] == 2) {
    $deleteErrorMessage = '<div style="color: red;">Error deleting Device. Please try again.</div>';
} elseif (isset($_SESSION['deleteError']) && $_SESSION['deleteError'] == 3) {
    $deleteErrorMessage = '<div style="color: red;">Invalid request. Please try again.</div>';
}

// Clear the session variables
unset($_SESSION['deleteSuccess']);
unset($_SESSION['deleteError']);


// Check for update success or failure messages
$updateSuccess = '';
$updateFailure = '';

if (isset($_SESSION['update_success']) && $_SESSION['update_success'] = true) {
  $updateSuccess = '<div style="color: green;">Device updated successfully!</div>';
} elseif (isset($_SESSION['update_failure']) && $_SESSION['update_failure'] = true) {
  $updateFailure = '<div style="color: red;">Unsuccessful Update.</div>';}

  unset($_SESSION['update_success']);
  unset($_SESSION['update_failure']);

  // Check for update success or failure messages
$AddSuccess = '';
$AddFailure = '';

if (isset($_SESSION['successAdd']) && $_SESSION['successAdd'] = true) {
  $AddSuccess = '<div style="color: green;">Device Added successfully!</div>';
} elseif (isset($_SESSION['errorAdd']) && $_SESSION['errorAdd'] = true) {
  $AddFailure = '<div style="color: red;">Unsuccessful to Added device.</div>';}

  unset($_SESSION['successAdd']);
  unset($_SESSION['errorAdd']);


?>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SI Computer - Tracking Order</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/additionalStyle.css" rel="stylesheet">


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

	 <h1>My Devices List</h1>
	 
	            <section class="section fade-in">
                    <div class="row">
		 <!-- Bootstrap modals -->
							<?php if ($deleteSuccessMessage): ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?php echo $deleteSuccessMessage; ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>

							<?php if ($deleteErrorMessage): ?>
								<div class="alert alert-danger" role="alert">
									<?php echo $deleteErrorMessage; ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>  

							<?php if ($updateSuccess): ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong><?php echo $updateSuccess; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>

							<?php if ($updateFailure): ?>
								<div class="alert alert-danger" role="alert">
								<strong><?php echo $updateFailure; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>  

							<?php if ($AddSuccess): ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong><?php echo $AddSuccess; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>

							<?php if ($AddFailure): ?>
								<div class="alert alert-danger" role="alert">
								<strong><?php echo $AddFailure; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>  
							
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
               <div class="row mb-3">
                             </div>
 				  
                      <?php
                            // Select device data
                            $query = "SELECT * FROM DEVICE                           
                            WHERE
                            CUSTOMERID = '$cust_id' AND DEVICESTATUS = 'ACTIVE'";
                            
                            $queryDevice = mysqli_query($conn, $query);
              

                            // Check if query execution is successful
                            if (!$queryDevice) {
                                die("Error fetching service data: " . mysqli_error($conn));
                            }

                            // Fetch data from the result set
                            while ($fetch_device = mysqli_fetch_assoc($queryDevice)) {
                                // Your existing code for processing each row goes here
                          ?>
                      <div class="col-lg-4"> <!-- 1 kotak -->
                        <div class="card">
                             <div class="card-body">
								  
								  <h5 class="card-title" name="id" >Device ID: <?php echo $fetch_device['DEVICEID']; ?></h5>
								  <p class="card-text" name = "name" > Device Name: <?php echo $fetch_device['DEVICENAME']; ?></p>
								  <p class="card-text" name = "type" > Device Type: <?php echo $fetch_device['DEVICETYPE']; ?></p>
								  <p class="card-text" name = "desc" > Device Description: <?php echo $fetch_device['DEVICEDESC']; ?></p> 				
                  <form method ='POST' action ="editDevice.php">
                  <input type="hidden" name="DEVICE_ID" value="<?php echo $fetch_device['DEVICEID']; ?>" />
								  <button
									type="submit"
									class="btn btn-primary"
									name= "edit">
									Edit
										</button>
									
								  <a href="process-deleteDevice.php?delete=<?php echo $fetch_device['DEVICEID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this device?')">Delete</a>
										
							 </div> 
              </form>
			             </div>
                      </div>
	   <!-- payment detail 1 end -->
	  <?php
	  }
	  ?>
	</div>
  </section>

      <!-- Modal -->
      <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              
              <h5 class="modal-title"  style="text-align=center;" id="modalCenterTitle">Add Device</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form method ='POST' action ="process-createDevice.php" onsubmit="return validateForm()">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameWithTitle" class="form-label">Device Name</label>
                  <input
                    type="text"
                    name = "name"
                    id="name"
                    class="form-control"
                    placeholder="Enter Name  (example: Acer Aspire 5)" required />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="emailWithTitle" class="form-label">Device Type</label>
                  <input
                    type="text"
                    id="type"
                    name = "type" 
                    class="form-control"
                    placeholder="Enter Type  (example: Laptop/PC)" required/>
                </div>
              </div>
			  
			  <div class="row">
                <div class="col mb-3">
                  <label for="emailWithTitle" class="form-label">Device Description</label>
                  <input
                     type="text"
                    id="description"
                    name = "description" 
                    class="form-control"
                    placeholder="Enter Decription (example:password / color / sirial number)" />
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
          </div>
        </div>
      </div> <!-- Modal end -->
      </div>					
    </div>

</main>

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