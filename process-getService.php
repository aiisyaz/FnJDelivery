<?php

session_start();
include('../include/config.php');

// Fetch SERVICE information based on the provided ID
if (isset($_POST['SERVICE_ID'])) {
    

    // Sanitize input data to prevent SQL injection
    $SERVICE_ID = $conn->real_escape_string($_POST['SERVICE_ID']);

    // Prepare the SQL query
    $query = "SELECT DISTINCT S.*, C.CUSTOMER_ID, C.CUSTOMER_NAME, T.TRACK_STATUS, R.* 
              FROM SERVICE S 
              JOIN CUSTOMER C ON C.CUSTOMER_ID = S.CUSTOMER_ID
              JOIN TRACKSERVICE T ON S.SERVICE_ID = T.SERVICE_ID
              LEFT JOIN RIDER R ON T.RIDER_ID = R.RIDER_ID 
              WHERE S.SERVICE_ID = ?";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $SERVICE_ID);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Get the result set
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Fetch data
            $serviceData = $result->fetch_assoc();
            echo json_encode($serviceData);
        } else {
            echo json_encode(['error' => 'No service found with the provided ID']);
        }
    } else {
        // Log or echo the error
        echo json_encode(['error' => $conn->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
