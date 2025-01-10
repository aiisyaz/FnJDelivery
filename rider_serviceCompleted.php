<?php
// Inialize session
session_start();

include('../include/config.php');

$staff_id = $_SESSION['staff_id'];
$staff_name = $_SESSION['staff_name'];

if (!isset($staff_id)) {
    header('location: admin_login.php');
    exit;
}

 // Select delivery data
 $query = "SELECT 
 c.CUSTOMERID,
 c.CUSTOMERNAME,
 c.CUSTOMERPHONENUMBER,
 s.SERVICENAME,
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
 CUSTOMER c ON sd.CUSTOMERID = c.CUSTOMERID
 JOIN 
 TRACKING t ON sd.SERVICEDETAILSID = t.SERVICEDETAILSID 
 WHERE (t.TRACKSTATUS = 'COMPLETED' 
 OR t.TRACKSTATUS = 'ARRIVED AT THE STORE') 
 AND t.STAFFID = '$staff_id'";
 
 $queryService = mysqli_query($conn, $query);

 // Check if query execution is successful
 if (!$queryService) {
   die('Query Failed: ' . mysqli_error($conn));
 }
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
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Rider</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="rider_index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Home</div>
              </a>
            </li>

            <!-- service management-->
            <li class="menu-item active">
              <a href="currentstatus.php"  class="menu-link">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Service Management </div>
              </a>
            </li>

           
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Authentications</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="logout.php" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Logout</div>
                  </a>
                </li>
                <li class="menu-item">

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
              <p><?php echo $staff_name; ?></p>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                
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
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="btn btn-outline-secondary" href="currentstatus.php"><i class="bx bx-pie-chart-alt me-1"></i> In Progress</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="rider_serviceCompleted.php"><i class="bx bx-check-shield me-1"></i> Completed</a>
                    </li>
                  </ul>
                    <!-- Striped Rows -->
                    <div class="card">
                      <h5 class="card-header">Service Completed</h5>
                      <div class="table-responsive text-nowrap">

                          <!-- Display success message -->
                        <?php if (isset($_SESSION['update_success']) && $_SESSION['update_success']) : ?>
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              Status updated successfully!
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          <?php unset($_SESSION['update_success']); ?>
                        <?php endif; ?>

                      <!-- Display failure message -->
                      <?php if (isset($_SESSION['update_failure']) && $_SESSION['update_failure']) : ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to update status. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <?php unset($_SESSION['update_failure']); ?>
                      <?php endif; ?>
                      
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Service id</th>
                              <th>Service Date Time</th>  
                              <th>Customer name</th>
                              <th>Phone Number</th>
                              <th>Service Type</th>
                              <th>Service Details</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <?php
                           
                            
                            while ($fetch_service = mysqli_fetch_assoc($queryService)) {
                           
                          ?>
                          <tbody class="table-border-bottom-0">
                            <tr>
                              
                              <td><i  name="service_id" class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $fetch_service['SERVICEDETAILSID']; ?></strong></td>
                              <td><?php echo $fetch_service['SERVICEDETAILSTIMESTAMP']; ?></td>
                              <td><div  name="customer_name" ><?php echo $fetch_service['CUSTOMERNAME']; ?></div></td>
                              <td>                      
                                <?php echo $fetch_service['CUSTOMERPHONENUMBER']; ?>
                              </td>
                              <td>                      
                                <?php echo $fetch_service['SERVICENAME']; ?>
                              </td>
                              <td>
                                <a style="color:#138808; text-decoration-line: underline;" data-bs-toggle="modal" data-bs-target="#modalDevice<?php echo $fetch_service['SERVICEDETAILSID']; ?>">Details</a>
                              </td>

                              <td><div name="track_status"><?php echo $fetch_service['TRACKSTATUS']; ?></div></td>
                              <td>
                                <div class="col-lg-4 col-md-6">
                                  <input type="hidden" name="customer_id" value="<?php echo $fetch_service['CUSTOMERID']; ?>">
                                      

                                </div>   
                                

                                  <!-- Modal 2 -->
                                <?php
                                  $service_id = $fetch_service['SERVICEDETAILSID'];
                                  // Select DEVICE data
                                  $query = "SELECT DISTINCT s.SERVICENAME, sd.SERVICEDETAILSINVOICENUM, d.DEVICETYPE, d.DEVICENAME, d.DEVICEID, d.DEVICEDESC
                                  FROM SERVICE s
                                  JOIN
                                      SERVICEDETAILS sd ON s.SERVICEID = sd.SERVICEID
                                  JOIN 
                                      SERVICEDETAILSDEVICE sdv ON sd.SERVICEDETAILSID = sdv.SERVICEDETAILSID
                                  JOIN
                                      DEVICE d ON sdv.DEVICEID = d.DEVICEID 
                                      WHERE sdv.SERVICEDETAILSID = '$service_id'";
                                  
                                  $queryDevice = mysqli_query($conn, $query);

                                  // Check if query execution is successful
                                  if ($queryDevice) {
                                ?>
                                <div class="modal fade" id="modalDevice<?php echo $fetch_service['SERVICEDETAILSID']; ?>" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="modalCenterTitle">SERVICE DETAILS FOR <?php echo $fetch_service['SERVICEDETAILSID']; ?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                            <div class="mb">
                                                <table>
                                                <tr>
                                                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Location </strong></td>
                                                      <td><?php echo $fetch_service['SERVICEDETAILSLOCATION']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Time </strong></td>
                                                        <td><?php echo $fetch_service['SERVICEDETAILSTIMESTAMP']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Invoice ID </strong></td>
                                                        <td><?php echo $fetch_service['INVOICENUM']; ?></td>
                                                    </tr>
                                                    <?php
                                                    if (mysqli_num_rows($queryDevice) > 0) {
                                                      while ($device = mysqli_fetch_assoc($queryDevice)) {
                                                        // Your existing code for processing each row goes here
                                                        ?>
                                                        
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Device ID </strong></td>
                                                            <td><?php echo $device['DEVICEID']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Device Name &nbsp; </strong></td>
                                                            <td><?php echo $device['DEVICENAME']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Device Type </strong></td>
                                                            <td><?php echo $device['DEVICETYPE']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Device Description </strong></td>
                                                            <td><?php echo $device['DEVICEDESC']; ?></td>
                                                        </tr>
                                                        <tr>
                                                          <td style="text-align:center;">-------------------</td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="2" style="text-align:center;">No devices found.</td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!-- END MODAL -->
                              </td>
                            </tr>                       
                          </tbody>
                          <?php
                              } 
                          ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
        
                
              </div>
              <!--/ Striped Rows -->

              <hr class="my-5" />

              
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

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('[name="updateStatus"]').addEventListener('click', function () {
          var selectedValue = document.querySelector('[name="track_service"]').value;
          console.log('Selected Value:', selectedValue);
        });
      });
    </script>
  </body>
</html>