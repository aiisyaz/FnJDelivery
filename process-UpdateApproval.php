<?php
// Initialize session
session_start();

include('../include/config.php');

if (isset($_POST['updateStatus'])) {
    // Sanitize user input
    $update_status = htmlspecialchars($_POST['track_service'], ENT_QUOTES, 'UTF-8');
    $service_id = $_SESSION['service_id'];

    // Use prepared statement to prevent SQL injection
    $query = "UPDATE TRACKSERVICE SET TRACK_STATUS = ?, ADMIN_ID = 'A100', TRACK_TIMESTAMP = NOW() WHERE SERVICE_ID = ?";
    $update_statement = $conn->prepare($query);

    // Bind parameters
    $update_statement->bind_param("si", $update_status, $service_id);

    // Execute the query
    $result = $update_statement->execute();

    if ($result) {
        // Set a session variable to indicate successful update
        $_SESSION['update_success'] = true;
        // Redirect to your desired location
        header('location: custRequest.php');
        exit;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
        // Get more details about the error
        echo "Error updating status: " . $conn->error;
        // You might want to handle the error more gracefully, log it, or display an appropriate message to the user.
    }

    // Close the statement
    $update_statement->close();
}
?>
