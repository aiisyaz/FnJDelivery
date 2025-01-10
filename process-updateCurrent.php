<?php
// Initialize session
session_start();

include('../include/config.php');

$rider_id = $_SESSION['rider_id'];
$rider_name = $_SESSION['rider_name'];

if (isset($_POST['updateStatus'])) {
    // Sanitize user input
    $update_status = $_POST['track_service'];
    $service_id = $_POST['service_id'];

    // Prepare the update query
    $update_query = mysqli_query($conn, "UPDATE TRACKING SET TRACKSTATUS = '$update_status', TRACKTIMESTAMP = NOW() WHERE SERVICEDETAILSID = '$service_id'");

    if ($update_query) {
        // Set a session variable to indicate successful update
        $_SESSION['update_success'] = true;
        header('location: currentstatus.php');
        exit;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
        // Get more details about the error
        echo "Error updating status: " . $conn->error;
        // You might want to handle the error more gracefully, log it, or display an appropriate message to the user.
    }

}
?>
