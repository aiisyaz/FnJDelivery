<?php
    session_start();


    include('../include/config.php');

    $admin_id = $_SESSION['staff_id'];
    $admin_name = $_SESSION['staff_name'];
    if (!isset($admin_id)) {
        header('location: admin_login.php');
        exit;}
    // if (!isset($rider_id)) {
    //     header('location: rider_login.php');
    //     exit;
    // }
   

?>  
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
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

    <title>F&J Delivery</title>

    <meta name="description" content="" />

    <!-- F&J -->
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

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="../assets/img/avatars/logo.jpg" alt="Avatar" class="rounded-circle" width="50">
                
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">F&J Delivery</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="admin_index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- rider management-->
            <li class="menu-item">
              <a href="riderList.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Rider management</div>
              </a>
            </li>

            <!-- customer management-->
            <li class="menu-item">
              <a href="custList.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Customer management</div>
              </a>
            </li>
            <!-- service management-->
            <li class="menu-item active">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">F&J service management</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="serviceList.php" class="menu-link">
                    <div data-i18n="Without navbar">Manage Service</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="riderSchedule.php" class="menu-link">
                    <div data-i18n="Without menu">Manage Status</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="cityList.php" class="menu-link">
                    <div data-i18n="Without menu">City List</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <!-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div> -->
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/profile.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/profile.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $admin_name; ?></span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

            <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">FnJ Service Management /</span> New Service Request</h4>

              <!-- Basic Layout -->
              <div class="row">
                   <?php if (isset($_SESSION['update_success']) && ($_SESSION['update_success'] == 1)) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Service price has been updated successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['update_success']); ?>
                        <?php endif; ?>

                        <!-- Display failure message -->
                        <?php if (isset($_SESSION['update_failure']) && ($_SESSION['update_failure'] == 1)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Service detail do not exist in the database!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['update_failure']); ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['update_failure']) && ($_SESSION['update_failure'] == 2)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Database Error! A problem has occured while executing the SQL command!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['update_failure']); ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['update_failure']) && ($_SESSION['update_failure'] == 3)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                No changes have been made!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php unset($_SESSION['update_failure']); ?>
                        <?php endif; ?>
                 


                 
         
                        <?php
                        // Select SERVICE data
                        $query = "SELECT * FROM SERVICE";

                        $queryService = $conn->query($query);

                        // Check if query execution is successful

                        if (!$queryService) {
    
                          $error_message = $conn->error;
    
                          trigger_error(htmlentities($error_message, ENT_QUOTES), E_USER_ERROR);

                        }
                        // Fetch data from the result set

                        while ($fetch_service = $queryService->fetch_assoc()) {
   
                          // Your existing code for processing each row goes here
                        

                          ?>
                <div class="col-xl">
                  <div class="card mb-4">
              
                    <div class="card-header d-flex justify-content-between align-items-center">
            <!-- Display success message -->
                    
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Service Id</label>
                            <span class="input-group-text"><?php echo $fetch_service['SERVICEID']; ?></span>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Service Name</label>
                           <span class="input-group-text"><?php echo $fetch_service['SERVICENAME'];?> </span>
                        </div>
                        <div class="mb-3">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">Service Fee</label>
                            <span class="input-group-text">
                            <?php echo $fetch_service['SERVICEPRICE']; ?> </span>
                        </div>
                       <button type="button" class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#modalService" data-service-price="<?php echo $fetch_service['SERVICEPRICE']; ?>" data-service-id="<?php echo $fetch_service['SERVICEID']; ?>">Edit</button>   
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                <?php
                }
                ?>
            </div>
    </div>
            </div>
            <!-- / Content -->

<!-- Modal -->
                        <div class="modal fade" id="modalService" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <!-- Inside the modal form -->
                                <form action="process-editService.php" method="POST">
                                    <!-- Hidden input field to store the service ID -->
                                    <input type="hidden" id="serviceID" name="serviceID">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Edit Service Fee</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                          <div class="mb">
                                              <label for="serviceFee" class="form-label">Service Fee</label>
                                              <!-- Add the id attribute to the input field -->
                                              <input type="text" id="servicePrice" name="serviceFee">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" id="saveServiceChanges" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>

                              </div>
                          </div>
                        </div>
                  


            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  ,by
                  <a href="" target="_blank" class="footer-link fw-bolder">F&J Delivery</a>
                </div>
                <!-- <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div> -->
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      // JavaScript code to handle button click event
      document.addEventListener('DOMContentLoaded', function () {
          var editServiceButtons = document.querySelectorAll('.edit-service');

          editServiceButtons.forEach(function (button) {
              button.addEventListener('click', function () {
                  var serviceID = button.getAttribute('data-service-id');
                  var servicePrice = button.getAttribute('data-service-price');

                  // Set the service ID and price in the modal form
                  document.getElementById('serviceID').value = serviceID;
                  document.getElementById('servicePrice').value = servicePrice;
              });
          });

          // Add click event listener to save changes button
          document.getElementById('saveServiceChanges').addEventListener('click', function () {
              // Retrieve the updated service price from the modal input field
              var updatedServicePrice = document.getElementById('servicePrice').value;
              // Perform further processing, e.g., update the database
          });
      });

    </script>
  </body>
</html>