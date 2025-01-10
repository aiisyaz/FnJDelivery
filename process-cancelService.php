<?php

session_start();

include('include/config.php');

// Check for update success or failure messages
$updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
$updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];

if ($updateSuccess) {
    unset($_SESSION['update_success']); // Reset the session variable
}

if ($updateFailure) {
    unset($_SESSION['update_failure']); // Reset the session variable
}

if (isset($_GET['SERVICE_ID'])) {
    // Ensure you have a valid database connection in $conn
    $service_id = $_GET['SERVICE_ID'];
    
    // Use MySQLi functions for database operations
    $update_query = "UPDATE TRACKING SET TRACKSTATUS = 'CANCELLED', TRACKTIMESTAMP = NOW() WHERE SERVICEDETAILSID = '$service_id'";

    $result = mysqli_query($conn, $update_query);

    if ($result) {
        // Set a session variable to indicate successful update
        $_SESSION['update_success'] = true;
        header('location: serviceCancelled.php');
        exit;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
    }

    header('location: serviceInComing.php');
    exit;
}
?>
