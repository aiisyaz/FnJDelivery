<?php
session_start();
include('../include/config.php');

$staff_id = $_SESSION['staff_id'];
$staff_name = $_SESSION['staff_name'];

if (!isset($staff_id)) {
    header('location: rider_login.php');
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accept'])) {
        // Validate and sanitize input
        if (!isset($_POST['service_id'])) {
            // Handle the case where 'service_id' is not set
            echo "Service ID is not set.<br>";
            exit;
        }
        $service_id = $_POST['service_id'];
        $_SESSION['service_id'] = $service_id;

        // Select data from TRACKSERVICE for the given service_id using prepared statement
        $query = "SELECT * FROM TRACKING WHERE SERVICEDETAILSID = ?";
        $select_statement = $conn->prepare($query);
        $select_statement->bind_param("s", $service_id);
        $select_statement->execute();
        $result = $select_statement->get_result();

        if (!$result) {
            $error_message = $conn->error;
            // Log or display user-friendly error message
            echo "Error fetching data from TRACKSERVICE table: $error_message<br>";
            exit;
        }

        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        if (!$row) {
            $error_message = "No data found for service ID: $service_id";
            // Log or display user-friendly error message
            echo "Error fetching data from TRACKSERVICE table: $error_message<br>";
            exit;
        }

        // Update TRACKSERVICE table with rider ID and status
        $update_query = "UPDATE TRACKING SET TRACKSTATUS = 'IN PROGRESS', STAFFID = ?, TRACKTIMESTAMP = NOW() WHERE SERVICEDETAILSID = ?";
        $update_statement = $conn->prepare($update_query);
        $update_statement->bind_param("ss", $staff_id, $service_id);
        $result2 = $update_statement->execute();

        if (!$result2) {
            $error_message = $conn->error;
            // Log or display user-friendly error message
            echo "Error updating TRACKSERVICE table: $error_message<br>";
            exit;
        } else {
            // Redirect to currentstatus.php
            header('location: currentstatus.php');
            exit;
        }
    } elseif (isset($_POST['reject'])) {
        // Process rejection of the service request
        // Update the status of the service request to 'REJECTED'
        
        // Hide the Reject button using JavaScript
        echo '<script>hideRejectButton(' . $_POST['service_id'] . ');</script>';
    }
    header('location: rider_index.php');
    exit;
}
?>
