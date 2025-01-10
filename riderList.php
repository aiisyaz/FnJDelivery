<?php
    session_start();

    include('../include/config.php');

    $admin_id = $_SESSION['staff_id'];
    $admin_name = $_SESSION['staff_name'];
    if (!isset($admin_id)) {
        header('location: admin_login.php');
        exit;}
    // Check for update success or failure messages
    $updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
    $updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];
    unset($_SESSION['update_success']);
    unset($_SESSION['update_failure']);

    if (isset($_SESSION['deleteSuccess']) && $_SESSION['deleteSuccess'] == 1) {
      echo '<div style="color: green;">Rider deleted successfully!</div>';
  } elseif (isset($_SESSION['deleteError']) && $_SESSION['deleteError'] == 1) {
      echo '<div style="color: red;">Rider not found for deletion.</div>';
  } elseif (isset($_SESSION['deleteError']) && $_SESSION['deleteError'] == 2) {
      echo '<div style="color: red;">Error deleting rider. Please try again.</div>';
  } elseif (isset($_SESSION['deleteError']) && $_SESSION['deleteError'] == 3) {
      echo '<div style="color: red;">Invalid request. Please try again.</div>';
  }

  // Clear the session variables
  unset($_SESSION['deleteSuccess']);
  unset($_SESSION['deleteError']);

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
            <a href="admin_index.php" class="app-brand-link">
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
            <li class="menu-item active">
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
            <li class="menu-item">
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
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              
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
                      <a class="dropdown-item" href="logout.php">
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
              <div class="row">
                <div class="col-lg mb-4 order-0">
                  <!-- Success Message Box -->
                  <?php if ($updateSuccess): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Update successful!</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  <?php endif; ?>

                  <!-- Failure Message Box -->
                  <?php if ($updateFailure): ?>
                      <div class="alert alert-danger" role="alert">
                          <strong>Update failed. Please try again.</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  <?php endif; ?>

                  <!-- Striped Rows -->
                  <div class="card">
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="card-header"><span class="text-muted fw-light">Rider Management /</span> List of Rider</h5>
                      <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="navbar-nav align-items-center">
                          <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                              type="text"
                              class="form-control border-0 shadow-none"
                              placeholder="Search..."
                              aria-label="Search..."
                              name="search_item"
                            />
                          </div>
                        </div>
                      </form> 
                      <a href="riderList.php" class="btn btn-primary" style="background-color:#28a745; margin-right:15px;" > Display All </a>                    
                    </div> 
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">                    
                       
                    </ul>
                    <div class="table-responsive text-nowrap">
                      <form method='POST'>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Rider ID</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <?php
                            if (isset($_GET['search_item']) && !empty($_GET['search_item'])) {
                                $search_item = $_GET['search_item'];
                                $query = "SELECT * FROM STAFF WHERE LOWER(STAFFID) LIKE LOWER('%$search_item%') OR LOWER(STAFFNAME) LIKE LOWER('%$search_item%') OR LOWER(STAFFPHONENUM) LIKE LOWER('%$search_item%') OR LOWER(STAFFEMAIL) LIKE LOWER('%$search_item%') OR LOWER(STAFFSTATUS) LIKE LOWER('%$search_item%')";
                            } else {
                                $query = "SELECT * FROM STAFF WHERE STAFFROLE = 'rider'";
                            }

                            $result = $conn->query($query);
                            if ($result) {
                              while ($fetch_rider = $result->fetch_assoc()){
                                    // Your existing code for displaying rider information
                          ?>
                          <tbody class="table-border-bottom-0">
                            <tr>
                              <td><?php echo $fetch_rider['STAFFID']; ?></td>
                              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $fetch_rider['STAFFNAME']; ?></strong></td>
                              <td><?php echo $fetch_rider['STAFFPHONENUM']; ?></td>
                              <td><?php echo $fetch_rider['STAFFEMAIL']; ?></td>
                              <td><span class="badge bg-label-success me-1"><?php echo $fetch_rider['STAFFSTATUS']; ?></span></td>
                              <td><a href="riderDetails.php?RIDER_ID=<?php echo $fetch_rider['STAFFID']; ?>" class="btn btn-primary"><i name = "edit" class="bx bx-edit-alt me-1"></i> Edit</a>
                              </td>
                            </tr>
                          </tbody>
                          <?php                           
                                  }
                              }
                          ?>
                        </table>
                      </form>
                    </div>
                  </div>
                  <!--/ Striped Rows -->             
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , by
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
    </div>
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
    
  </body>
  
</html>
