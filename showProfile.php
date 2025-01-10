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

$updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
$updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];
unset($_SESSION['update_success']);
unset($_SESSION['update_failure']);

?>

<!DOCTYPE html>
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

        <div class="content-wrapper">
            <!-- Content -->


            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span>Account Settings</span> </h4>
			      <!-- Success Message Box -->
					<?php if ($updateSuccess): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Updated successfully!</strong>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php endif; ?>
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
				
                    <div class="p-4">
                        <?php
                        $select_customer = mysqli_query($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMERID = '$cust_id'");

                        if ($row = mysqli_fetch_assoc($select_customer)) {
                        ?>
						
                            <div class="box">
                                <div class="text-center"><h5><?php echo $row['CUSTOMERNAME']; ?></h5></div>
                            </div>
                        </div>
                        <!-- <div class="nav flex-column nav-pills" style="color:#000;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="account-tab" data-toggle="pill" style="color:#000;" href="#account" role="tab" aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Account
                            </a>
                             <a class="nav-link" id="password-tab" data-toggle="pill" style="color:#000;" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Password
                            </a>
                        </div>
                    </div> -->
					
						<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
								
								<div class="row">
									<div class="col-md-6">
										<form method="post" action="process-editProfile.php" id="updateProfileForm" onsubmit="return validateForm()">
											<div class="form-group">
												<label>Name</label>
												<input type="text" class="form-control" name="update_name" value="<?php echo $row['CUSTOMERNAME']; ?>" required>
											</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>ID NUMBER (NRIC)</label>
											<input type="text" class="form-control" name="update_ID" value="<?php echo $row['CUSTOMERID']; ?>" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" name="update_email" value="<?php echo $row['CUSTOMEREMAIL']; ?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone number</label>
											<input type="text" class="form-control" name="update_phoneNum" value="<?php echo $row['CUSTOMERPHONENUMBER']; ?>" required>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" name="update_profile" class="btn btn-primary">Update</button>
								</div>
								</form>
							
							<!-- <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
							<form method="post" action="process-editProfile.php">	
							<h3 class="mb-4">Password Settings</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Old password</label>
											<input type="password" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>New password</label>
											<input type="password" name="update_password" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Confirm new password</label>
											<input type="password" name="confirm_password" class="form-control">
										</div>
									</div>
								</div>
								<div>
									<button class="btn btn-light" name="update_password">Update </button>
									<button class="btn btn-light">Cancel</button>
								</div>
							</div>
							<?php
							}
							?>
						</form> -->
                    </div>
                </div>
            </div>
			</section>
			
		</div>	
        </div>
       </main>
		<!-- Footer -->
		<footer class="content-footer footer bg-footer-theme">
			<!-- Copyright -->
			<p style="text-align:center;">&copy; 2024. All rights reserved.</p>
			<p style="text-align:center;"> F&J Delivery</p>
        </footer>

		<!-- Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollex.min.js"></script>
		<script src="js/browser.min.js"></script>
		<script src="js/breakpoints.min.js"></script>
		<script src="js/util.js"></script>
		<script src="js/main.js"></script>
		<script src="js/form.js"></script>
		<script>
            function showPopup(message, messageType) {
				const popupContainer = document.getElementById('popup-container');
				const popupMessage = document.getElementById('popup-message');
				const popupCloseBtn = document.getElementById('popup-close-btn');

				popupMessage.innerHTML = message;
				popupMessage.className = messageType;

				popupContainer.style.display = 'block';

				// Close the popup when the close button is clicked
				popupCloseBtn.onclick = function () {
					popupContainer.style.display = 'none';
				};

				// Close the popup when clicking outside the popup
				window.onclick = function (event) {
					if (event.target === popupContainer) {
						popupContainer.style.display = 'none';
					}
				};
			}
        </script>

		<script>
			function validateForm() {
			var name = document.forms["updateProfileForm"]["update_name"].value;
			var email = document.forms["updateProfileForm"]["update_email"].value;
			var phoneNum = document.forms["updateProfileForm"]["update_phoneNum"].value;

			console.log("Name:", name);
			console.log("Email:", email);
			console.log("Phone Number:", phoneNum);

			// Check if any required field is empty
			if (name === '' || email === '' || phoneNum === '') {
				alert("Please fill out all required fields.");
				return false; // Prevent form submission
			}

			// Validate name: allow letters, numbers, spaces, specific characters like ' and @
			if (!/^[a-zA-Z0-9\s'@-’]+$/.test(name)) {
				alert("Invalid characters in Name.");
				return false; // Prevent form submission
			}

			// Validate email format using a basic regex pattern
			if (!/^[\w-]+(\.[\w-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/.test(email)) {
				alert("Invalid Email format. Please enter a valid email address.");
				return false; // Prevent form submission
			}

			// Validate phone number: allow only numbers and optional '+' at the start
			if (!/^[0-9+]$/.test(phoneNum)) {
				alert("Invalid Phone Number format. Please use only numbers.");
				return false; // Prevent form submission
			}
			return true; // Allow form submission

			// Check phone number length
			if (phoneNum.length > 11 || phoneNum.length < 10) {
				alert("Invalid Phone Number.");
				return false; // Prevent form submission
			}
			// Check name length
			if (name.length > 50) {
				alert("Name cannot exceed 50 characters.");
				return false; // Prevent form submission
			}
			// Check phone number length
			if (email.length > 50) {
				alert("Email cannot exceed 50 characters.");
				return false; // Prevent form submission
			}

		}

		</script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    </body>
</html>