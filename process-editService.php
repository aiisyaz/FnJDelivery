<?php

session_start();

include('include/config.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

if (!isset($cust_id)) {
    header('location: login/process.php');
    exit;
}

// Check for update success or failure messages
$updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
$updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];

if ($updateSuccess) {
    unset($_SESSION['update_success']); // Reset the session variable
}

if ($updateFailure) {
    unset($_SESSION['update_failure']); // Reset the session variable
}

if (isset($_POST['update'])) {
    // Assuming you have a valid database connection in $conn (not shown here)
    
    $service_id = $_POST['id'];
    $service_time = $_POST['time'];
    $service_date = $_POST['date'];
    $service_location = $_POST['location'];
    
    // Prepare the query
    $service_date_formatted = date('Y-m-d H:i:s', strtotime($service_date . ' ' . $service_time));
    $update_query = "UPDATE SERVICEDETAILS 
                     SET SERVICEDETAILSLOCATION = ?, 
                         SERVICEDETAILSTIMESTAMP = ? 
                     WHERE SERVICEDETAILSID = ?";

    // Initialize the prepared statement
    $stmt = mysqli_prepare($conn, $update_query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sss", $service_location, $service_date_formatted, $service_id);

        // Execute the query
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Set a session variable to indicate successful update
            $_SESSION['update_success'] = true;
            header('location: serviceInComing.php');
            exit;
        } else {
            // Set a session variable to indicate failure
            $_SESSION['update_failure'] = true;
        }

        mysqli_stmt_close($stmt);
    } else {
        // Set a session variable to indicate failure if the statement preparation failed
        $_SESSION['update_failure'] = true;
    }

    header('location: editServiceDetails.php');
    exit;
}
?>
