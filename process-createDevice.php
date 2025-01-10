<?php
session_start();
include('include/config.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

// Check if the customer is logged in
if (!isset($cust_id)) {
    header('Location: login/process.php');
    exit;
}

if (isset($_POST['add'])) {
    $deviceType = $_POST['type'];
    $deviceName = $_POST['name'];
    $deviceDesc = $_POST['description'];

    $device_query = mysqli_query($conn, "SELECT CONCAT('D', LPAD((SELECT COALESCE(MAX(SUBSTRING(deviceid, 2) + 1), 1) FROM DEVICE), 4, '0')) AS NEXTVAL");
    $device_id_row = mysqli_fetch_assoc($device_query);
    $device_id = $device_id_row['NEXTVAL'];

    // INSERT device details into the device table with prepared statement
    $add_device_query = mysqli_prepare($conn, "INSERT INTO DEVICE (DEVICEID, DEVICETYPE, DEVICENAME, DEVICEDESC, CUSTOMERID, DEVICESTATUS) 
                                        VALUES ('$device_id', '$deviceType', '$deviceName', '$deviceDesc', '$cust_id', 'ACTIVE')");

    // Execute the device query
    $device_query_result = mysqli_stmt_execute($add_device_query);

    if (!$device_query_result) {
        // Handle error and redirect to an error page
        $_SESSION['errorAdd'] = true;
        header('Location: view_device.php');
        exit;
    } else {
        // Handle success and redirect to a success page
        $_SESSION['successAdd'] = true;
        header('Location: view_device.php');
        exit;
    }
}
?>
