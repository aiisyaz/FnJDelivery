<?php

session_start();

include('include/config.php');

// if (!isset($cust_id)) {
//     header('location: login/process.php');
//     exit;
// }

// Check for update success or failure messages
$updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
$updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];

if ($updateSuccess) {
    unset($_SESSION['update_success']); // Reset the session variable
}

if ($updateFailure) {
    unset($_SESSION['update_failure']); // Reset the session variable
}


if (isset($_POST['edit'])) {
    // Assuming you have a valid database connection in $conn (not shown here)
    
    $device_id = $_POST['DEVICE_ID'];
    $device_type = $_POST['type'];
    $device_name = $_POST['name'];
    $device_desc = $_POST['desc'];

    // Prepare the query
    $update_query = "UPDATE DEVICE SET DEVICENAME = '$device_name', DEVICETYPE = '$device_type', DEVICEDESC = '$device_desc'
        WHERE DEVICEID = '$device_id'";

    // Execute the query
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        // Set a session variable to indicate successful update
        $_SESSION['update_success'] = true;
        header('location: view_device.php');
        exit;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
        header('location: editDevice.php');
        exit;
    }
}

?>
