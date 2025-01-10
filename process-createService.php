<?php
// Include database connection settings
include('include/config.php');

// Initialize session
session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Capture values from HTML form
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $serviceType = $_POST['serviceType'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $cust_id = $_POST['cust_id'];
    $invoice = $_POST['invoice'];
    $selectedDevices = $_POST['selectService'];

    // Create SERVICE ID using Oracle sequence
    $id_query = mysqli_query($conn, "SELECT CONCAT('S', LPAD((SELECT COALESCE(MAX(SUBSTRING(SERVICEDETAILSID, 2) + 1), 1) FROM SERVICEDETAILS), 4, '0')) AS NEXTVAL");
    $id_row = mysqli_fetch_assoc($id_query);
    $service_id = $id_row['NEXTVAL'];
    $_SESSION['service_id'] = $service_id;
    $servicedetailsid = $service_id;

    // Concatenate date and time before passing to TO_TIMESTAMP
    $datetime = "$date $time";

    // Format the datetime string to match MySQL's expected format (Y-m-d H:i:s)
    $formattedDatetime = date("Y-m-d H:i:s", strtotime($datetime));

    // create location
    $sql = "SELECT CITYNAME FROM CITY WHERE CITYID = '$city'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch the city name from the result set
        $row = mysqli_fetch_assoc($result);
        $cityName = $row['CITYNAME']; // Retrieve city name from the database
    } else {
        $cityName = 'Unknown'; // Default value if city not found or query fails
    }
    $serviceLocation = $address . ', ' . $cityName . ', ' . $state;

    // INSERT SQL for service details
    $query = "INSERT INTO SERVICEDETAILS (SERVICEDETAILSID, SERVICEDETAILSTIMESTAMP, SERVICEDETAILSLOCATION, SERVICEDETAILSINVOICENUM, CITYID, CUSTOMERID, SERVICEID) 
    VALUES ('$servicedetailsid', '$formattedDatetime', '$serviceLocation', '$invoice', '$city', '$cust_id', '$serviceType')";

    $insertResult = mysqli_query($conn, $query);

    // Check for errors during the execution of the query
    if (!$insertResult) {
        $error_message = mysqli_error($conn);
        echo "Error inserting into service table: $error_message";
        exit;
    }

    // Insert selected devices into SERVICEDETAILSDEVICE table
    foreach ($selectedDevices as $deviceId) {
        $queryDeviceService = "INSERT INTO SERVICEDETAILSDEVICE (SERVICEDETAILSID, DEVICEID) VALUES ('$servicedetailsid', '$deviceId')";
        $device = mysqli_query($conn, $queryDeviceService);
        
        // If insertion failed, handle the error
        if (!$device) {
            $error_message = mysqli_error($conn);
            echo "Error inserting into SERVICEDETAILSDEVICE table: $error_message";
            exit; // Exit the script or handle the error accordingly
        }
    }

    // Redirect to payment page after successful insertion
    header('Location: TEST.php');
    exit;
}
?>
