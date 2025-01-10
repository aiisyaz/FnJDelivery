<?php

session_start();
include('../include/config.php');

// Fetch rider information based on the provided ID
if (isset($_POST['RIDER_ID'])) {
    

    // Sanitize input data to prevent SQL injection
    $RIDER_ID = $conn->real_escape_string($_POST['RIDER_ID']);

    // Prepare the SQL query
    $query = "SELECT * FROM RIDER WHERE RIDER_ID = ?";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $RIDER_ID);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Get the result set
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Fetch data
            $riderData = $result->fetch_assoc();
            echo json_encode($riderData);
        } else {
            echo json_encode(['error' => 'No rider found with the provided ID']);
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
