<?php

session_start();
include('../include/config.php');

// Fetch customer information based on the provided ID
if (isset($_POST['customerId'])) {
    

    // Sanitize input data to prevent SQL injection
    $customerId = $conn->real_escape_string($_POST['customerId']);

    // Prepare the SQL query
    $query = "SELECT * FROM customer WHERE customer_id = ?";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $customerId);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Get the result set
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Fetch data
            $customerData = $result->fetch_assoc();
            echo json_encode($customerData);
        } else {
            echo json_encode(['error' => 'No customer found with the provided ID']);
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
