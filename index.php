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

    <title>F&J LOGIN</title>

    <meta name="description" content="" />

    <!-- f&j -->
    <link rel="icon" type="image/x-icon" href="F&J noBG.png" />

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

    body {

    color: #fff;
 
    background-color: #000;

    }

    /* table {
        width: 100%;
        text-align: left;
    }

    table td {
        padding: 0.5em 1em 0.5em 1em;
    }

    table th {
        text-align: left;
        padding: 0.5em 1em 0.5em 1em;
                    
    }
    
    fieldset{
    width : 500px;
    height: 300px;
    border-width: 5px; 
    }

    .main {
    margin-left: 420px; 
    }

    div{
    max-width: 500px;
    height: 100px;
    }

    #id{  
        width: 300px;  
        height: 30px;  
        border: none;  
        border-radius: 3px;  
        padding-left: 8px;  
    }  
    #password{  
        width: 300px;  
        height: 30px;  
        border: none;  
        border-radius: 3px;  
        padding-left: 8px;     
    }  

    #log{  
    position: relative;
            display: inline-block;
            border-radius: 0.35em;
            color: #333 !important;
            text-decoration: none;
            padding: 1em 5em 1em 5em;
            background-color: #07f757 ;
            border: 0;
            cursor: pointer;
            
            -moz-transition: background-color 0.35s ease-in-out;
            -webkit-transition: background-color 0.35s ease-in-out;
            -ms-transition: background-color 0.35s ease-in-out;
            transition: background-color 0.35s ease-in-out;
        } 

    a:link {
    color: #07f757;
    background-color: transparent;
    text-decoration: none;
    } */

    </style>
    <body>
    <body >
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                 <!-- Register -->
                <div class="card" style=>
                    <div class="card-body" >
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                            <img src="../image/F&J logo.jpg" alt="Avatar" class="rounded-circle" width="50">
                        
                            </span>
                            <span class="app-brand-text demo text-body fw-bolder"> F&J Delivery Login</span>
                            </a>
                        </div>
                        <h4 class="mb-2">Welcome to F&J Delivery!</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                                        <form id="formAuthentication" class="mb-3" method="POST" action="process.php">
                                               
                                            <div class="mb-3">
                                        
                                                <label for="id" class="form-label">ID (NRIC)</label>
                                                <input type="text" class="form-control" placeholder="Enter ID" name="id" id="id" required>
                                            </div> 
                                            <div class="mb-3">   
                                                <label for="pass" class="form-label">Password</label>
                                                <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required></td><br>
                                            </div>   
                                            <div class="mb-3">
                                              
                                                <input type="submit" class="btn btn-primary d-grid w-100" name="login" id="log" value="Log In">
                                          
                                            </div>
                                            <p class="text-center">
                                            <span>Don't have an account? </span>
                                            <a href="../signup/Register.php"><span style="color:#07f757;">SignUp</span></a>
                                            </p> 
                                        </form>
                             
                        </div>
                    </div>
                </div>
            </div> 
        </div>

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