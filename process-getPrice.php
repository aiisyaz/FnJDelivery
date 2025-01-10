<?php
session_start();

include('include/dbconnection.php');

if(isset($_GET['serviceId'])) {
    $serviceId = $_GET['serviceId'];

    // Perform a database query to fetch the service price based on the service ID
    // Adjust this query according to your database schema
    $query = "SELECT SERVICEPRICE FROM SERVICE WHERE SERVICEID = '$serviceId'";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':serviceId', $serviceId);
    oci_execute($stmt);

    // Check if the query executed successfully
    if($row = oci_fetch_assoc($stmt)) {
        // Retrieve the service price from the query result
        $servicePrice = $row['SERVICEPRICE'];

        // Return the service price as a JSON response
        echo json_encode(array('price' => $servicePrice));
    } else {
        // If service price not found, return an error message
        echo json_encode(array('error' => 'Service price not found for the selected service type.'));
    }
} else {
    // If service ID is not provided in the request, return an error message
    echo json_encode(array('error' => 'Service ID not provided.'));
}
?>
