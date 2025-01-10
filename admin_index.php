<?php
    session_start();

    include('../include/config.php');

    $staffid = $_SESSION['staff_id'];
    $staffname = $_SESSION['staff_name'];
    
    if (!isset($staffid)) {
        header('location: admin_login.php');
        exit;}

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
  <style>
    .grid-container {
      display: grid;
      grid-template-columns: 70% 50%;
    }
  </style>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="#" class="app-brand-link">
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
            <li class="menu-item active">
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
                <!-- Place this tag where you want the button to render. -->
                
                
  

                <!-- Icon Dropdown -->
                <!--/ Icon Dropdown -->

                <!-- User -->
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
                            <span class="fw-semibold d-block"><?php echo $staffname; ?></span>
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
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome To F&J Delivery</h5>
                          <p class="mb-4">
                            Congratulations on joining our team! As a user administrator, you hold the keys to streamline our operations and ensure top-notch delivery services. <br><br>

                            Get ready to optimize routes, manage logistics, and create a seamless delivery experience for our valued customers. <br><br>

                            Let's deliver greatness together!
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 order-2 mb-4" style="position:static;">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">New Notification</h5>
                    </div>
                    <div class="card-body">
                      <!-- Bootstrap Toasts Styles -->
                      <?php
                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        $currentDateTime = new DateTime();
                        $currentDate = $currentDateTime->format('Y-m-d'); // Get the current date in the format YYYY-MM-DD
                        $current_time = $currentDateTime->format('H:i:s'); // Get the current time in the format HH:MM:SS                        

                        // Notification query
                        $query1 = "SELECT ST.STAFFNAME, T.TRACKSTATUS,
                        DATE_FORMAT(T.TRACKTIMESTAMP, '%d/%m/%Y') AS TRACK_DATE,
                        DATE_FORMAT(T.TRACKTIMESTAMP, '%H:%i:%s') AS TRACK_TIME
                        FROM TRACKING T JOIN STAFF ST ON ST.STAFFID = T.STAFFID 
                        WHERE ST.STAFFROLE = 'RIDER' AND T.TRACKSTATUS <> 'IN PROGRESS' 
                        AND DATE_FORMAT(T.TRACKTIMESTAMP, '%Y-%m-%d') = ?
                        ORDER BY T.TRACKTIMESTAMP DESC";

                        $stmt = $conn->prepare($query1);
                        $stmt->bind_param("s", $currentDate);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $currentDateTime = new DateTime();

                        while ($row = $result->fetch_assoc()) {
                        $trackTime = $row['TRACK_TIME'];

                        // Calculate the time difference
                        $trackDateTime = DateTime::createFromFormat('H:i:s', $trackTime);
                        $interval = $currentDateTime->diff($trackDateTime);

                        // Format the time difference in a human-readable format
                        $timeDifference = '';
                        if ($interval->h > 0) {
                        $timeDifference .= $interval->h . ' hours';
                        }
                        if ($interval->i > 0) {
                        $timeDifference .= ' ' . $interval->i . ' minutes';
                        }
                        if ($interval->h == 0 && $interval->i == 0) {
                        $timeDifference = 'just now';
                        } else {
                        $timeDifference .= ' ago';
                        }
                        ?>
                        <div
                          class="bs-toast toast fade show"
                          role="alert"
                          aria-live="assertive"
                          aria-atomic="true"
                        >
                          <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">RIDER</div>
                            <small><?php echo $timeDifference ?></small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                          </div>
                          <div class="toast-body">
                            <?php 
                            if (isset($row['STAFFNAME'])) {
                                echo $row['STAFFNAME'] . " has accepted the delivery! Go check their delivery schedule.";
                            } else {
                                echo "A rider has accepted the delivery! Go check their delivery schedule.";
                            }
                            ?>
                        </div>
                        </div><br>
                        <?php
                        }
                        ?>
                    </div>
                  </div>
                </div>

                <!--/ Transactions -->

              </div>
              <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Order Statistics</h5>
                        <!-- <small class="text-muted">42.82k Total Sales</small> -->
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="orederStatistics"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                          <a class="dropdown-item" href="admin_index.php">Refresh</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                        <?php
                            // Select service count data
                            $query = "SELECT COUNT(*) AS TOTAL FROM SERVICEDETAILS";

                            $result = $conn->query ($query);
                            if($result->num_rows>0){

                            

                            // Fetch data from the result set
                            while ($fetch_type = $result->fetch_assoc()) {
                                // Your existing code for processing each row goes here
                          ?> 
                          <h2 class="mb-2"><?php echo $fetch_type['TOTAL'];?></h2>
                          <span>Total Orders</span>
                          <?php }
                          } else {
                            echo "<h2 class='mb-2'>0</h2>";
                            echo "<span>Total Orders</span>";
                          }
                           ?>
                        </div>
                        <!-- <div id="orderStatisticsChart"></div> -->
                        
                      </div>
                      <ul class="p-0 m-0">
                        
                           <?php
                            // Select service count data
                            $query = "SELECT S.SERVICENAME, COUNT(SD.SERVICEID) AS TOTALTYPE FROM SERVICEDETAILS SD
                            JOIN SERVICE S ON  S.SERVICEID = SD.SERVICEID
                            GROUP BY S.SERVICENAME";

                            $result = $conn->query ($query);
                            if ($result->num_rows > 0 ){

                            

                            // Fetch data from the result set
                            while ($fetch_type = $result->fetch_assoc()) {
                                // Your existing code for processing each row goes here
                          ?> 
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                            ><i class="bx bx-home-alt"></i
                            ></span>
                          </div>
                          
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0"><?php echo $fetch_type['SERVICENAME'];?></h6>
                              <!-- <small class="text-muted">Mobile, Earbuds, TV</small> -->
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold"><?php echo $fetch_type['TOTALTYPE'];?></small>
                            </div>
                          </div>
                             
                        </li>   
                        <?php                           
                                }
                              }else {
                                echo "<li class= 'd-flex mb-4 pb-1' >No services found</li>";
                              }
                            ?>                 
                      </ul>                      
                    </div>
                  </div>
                </div>
                <!--/ Order Statistics -->

                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >

                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="custList.php">View More</a>
                       
                              </div>
                            </div>
                          </div>
                          <?php
                                // Select service count data
                                $query = "SELECT COUNT(*) AS TOTAL FROM CUSTOMER";
                                $queryServiceType = mysqli_query($conn, $query);

                                // Fetch data from the result set
                                while ($fetch_type = mysqli_fetch_assoc($queryServiceType)) {
                                    // Your existing code for processing each row goes here
                            ?>
                          <span class="fw-semibold d-block mb-1">Total Customer</span>
                          <h3 class="card-title mb-2"><?php echo $fetch_type['TOTAL'];?></h3>
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +5 </small> -->
                        </div>
                        <?php                           
                            }
                        ?>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="riderList.php">View More</a>
                 
                              </div>
                            </div>
                          </div>
                          <?php
                                // Select service count data
                                $query = "SELECT COUNT(*) AS TOTAL FROM STAFF WHERE STAFFROLE='RIDER'";

                                $queryServiceType = $conn->query ($query);
                                

                                // Fetch data from the result set
                                if($result->num_rows>0){
                                while ($fetch_type = mysqli_fetch_assoc($queryServiceType)) {
                                    // Your existing code for processing each row goes here
                            ?>
                          <span>Total Rider</span>
                          <h3 class="card-title text-nowrap mb-1"><?php echo $fetch_type['TOTAL'];?></h3>                         
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                        <?php                           
                            }
                          }else{
                            echo "0 results";
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
            </div>
          
            
            <!-- / Content -->

            <!-- <div class="col-md-6 col-lg-4 mb-3">
              <div class="card">
                <h5 class="card-header">Quote</h5>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.Lorem
                      ipsum dolor sit amet, consectetur.
                    </p>
                    <footer class="blockquote-footer">
                      Someone famous in
                      <cite title="Source Title">Source Title</cite>
                    </footer>
                  </blockquote>
                </div>
              </div>
            </div> -->

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
