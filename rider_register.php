<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/F&J.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body style="background-color: grey;">
    <!-- Content -->

    <!-- Display error message if any -->
    <?php if (!empty($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card" style="">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="../assets/img/avatars/logo.jpg" alt="Avatar" class="rounded-circle" width="50">
                    
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">F&J Delivery</span>
                </a>
              </div>
              <!-- /Logo -->
              
              <p class="mb-4">Register for Rider!</p>

              <?php if(isset($_GET['error_message'])): ?>
                <div><?php echo $_GET['error_message']; ?></div>
              <?php endif; ?>

              <form id="formAuthentication" class="mb-3" action="process-register.php" method="POST" onsubmit= "return validateForm()">
                <div class="mb-3">
                  <label for="rider_id" class="form-label">Rider ID</label>
                  <input
                    type="text" class="form-control" id="rider_id" name="rider_id" placeholder="Enter your ID"
                    required/>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="rider_name" name="rider_name" placeholder="Enter your name" required />
                </div>
                <div class="mb-3">
                  <label for="phoneNumber" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" required/>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="rider_email" name="rider_email" placeholder="Enter your email" required/>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" 
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <button class="btn btn-primary d-grid w-100" name = "signup" >Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="rider_login.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <script>
      function validateForm() {
        const riderId = document.getElementById('rider_id').value.trim();
        const riderName = document.getElementById('rider_name').value.trim();
        const phoneNumber = document.getElementById('phoneNumber').value.trim();
        const email = document.getElementById('rider_email').value.trim();
        const password = document.getElementById('password').value.trim();
        
        if (!riderId || !riderName || !phoneNumber || !email || !password) {
            alert("All fields must be filled out");
            return false;
        }

        // Validate Rider Name length
        if (riderId.length > 12) {
            alert("Rider id is invalid.");
            return false; // Prevent form submission
        }

        if (!/^[a-zA-Z\s@'’-]+$/.test(riderName)) {
            alert("Rider name contains invalid characters.");
            return false;
        }
        // Validate Rider Name length
        if (riderName.length > 50) {
            alert("Rider name is too long.");
            return false; // Prevent form submission
        }

        // Validate Phone Number characters
        if (!/^[0-9]{10,11}$/.test(phoneNumber)) {
            alert("Invalid phone number.");
            return false; // Prevent form submission
        }

        if (!/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            alert("Invalid email format.");
            return false;
        }

         // Validate Email length
         if (email.length > 50) {
            alert("Email is too long.");
            return false; // Prevent form submission
        }

        if (password.length > 50) {
            alert("Password must be at least 8 characters long.");
            return false;
        }

        return true;
      }
    </script>
    <!-- build:js assets/vendor/js/core.js -->
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

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
