<?php

session_start();
include('include/config.php');

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

if (!isset($cust_id)) {
    header('location: login/process.php');
    exit;
}

// Fetch SERVICE information based on the provided ID
if (isset($_POST['SERVICE_ID'])) {
    $SERVICE_ID = $_POST['SERVICE_ID'];
    
    $query = "SELECT 
        c.CUSTOMERID,
        c.CUSTOMERNAME,
        c.CUSTOMERPHONENUMBER,
        s.SERVICENAME,
        DATE_FORMAT(sd.SERVICEDETAILSTIMESTAMP, '%d/%m/%Y') AS SERVICE_DATE,
        DATE_FORMAT(sd.SERVICEDETAILSTIMESTAMP, '%H:%i:%s') AS SERVICE_TIME,
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
        SERVICEDETAILSDEVICE sdv ON sd.SERVICEDETAILSID = sdv.SERVICEDETAILSID
    JOIN
        DEVICE d ON sdv.DEVICEID = d.DEVICEID          
    JOIN 
        CUSTOMER c ON d.CUSTOMERID = c.CUSTOMERID
    JOIN 
        TRACKING t ON sd.SERVICEDETAILSID = t.SERVICEDETAILSID 
    WHERE sd.SERVICEDETAILSID = '$SERVICE_ID'";

    $stmt = mysqli_query($conn, $query);

    if ($stmt) {
        $serviceData = mysqli_fetch_assoc($stmt);
        echo json_encode($serviceData);
    } else {
        // Log or echo the error
        $error = mysqli_error($conn);
        echo json_encode(['error' => $error]);
    }
}
?>
