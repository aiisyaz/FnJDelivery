<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../include/config.php');

// Check for update success or failure messages
$updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
$updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];

if ($updateSuccess) {
    unset($_SESSION['update_success']); // Reset the session variable
}

if ($updateFailure) {
    unset($_SESSION['update_failure']); // Reset the session variable
}

if (isset($_POST['update'])) {
    // Get input values from POST
    $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);
    $track_status = mysqli_real_escape_string($conn, $_POST['track_status']);
    $track_id = mysqli_real_escape_string($conn, $_POST['track_id']);

    $update_query = mysqli_query($conn, "UPDATE TRACKING SET STAFFID = '$rider_id', TRACKSTATUS = '$track_status', TRACKTIMESTAMP = NOW() WHERE TRACKID = '$track_id'");

    // Execute the query
    if ($update_query) {
        $_SESSION['update_success'] = true;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
    }

    // Redirect to riderSchedule.php regardless of the outcome
    header('Location: scheduleInProgress.php');
    exit;
}
?>
