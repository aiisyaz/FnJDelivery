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

    <title>F&J Register</title>

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
  <style>
    </style>

  <body style="background-color: grey;">
    <!-- Content -->
    
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card" style="">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="../image/F&J logo.jpg" alt="Avatar" class="rounded-circle" width="50">
                    
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder" style = "font">F&J Delivery</span>
                </a>
              </div>
              <!-- /Logo -->
              
              <p class="mb-4">Register</p>

              <?php if(isset($_GET['error_message'])): ?>
                <div style="color: red;"><?php echo $_GET['error_message']; ?></div>
              <?php endif; ?>

              <form class="mb-3" action="registerEngine.php" method="POST" onsubmit="return validateForm()">
                <div class="mb-3">
                  <label for="" class="form-label">Customer ID (NRIC)</label>
                  <input
                    type="text" class="form-control" id="ids" name="id" placeholder="Enter your ID"
                    required />
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required/>
                </div>
                <div class="mb-3">
                  <label for="phoneNumber" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="Phone_No" name="Phone_No" placeholder="Enter your phone number" required/>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required/>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="Password"
                      class="form-control"
                      name="Password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="Password"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <button class="btn btn-primary d-grid w-100" name = "signup" >Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="../login/index.php">
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
            var ids = document.getElementById('ids').value;
            var name = document.getElementById('name').value;
            var phone = document.getElementById('Phone_No').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('Password').value;

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
            if (!/^[0-9]{10,11}$/.test(phone)) {
              alert("Invalid Phone Number.");
              return false; // Prevent form submission
            }
        // Validate ID: allow only alphanumeric characters and exactly 12 characters long
        if (!/^[A-Za-z0-9]{12}$/.test(ids)) {
            alert("Invalid ID. ID must be alphanumeric and exactly 12 characters long.");
            return false; // Prevent form submission
        }

            if (password.length >50) {
                alert('Password is too long.');
                return false;
            }

            if (email.length >50) {
                alert('Email is too long.');
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
