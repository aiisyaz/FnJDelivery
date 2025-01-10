<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include('../include/config.php');

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
    $update_name = $_POST['update_name'];
    $update_ID = $_POST['update_ID'];

    // Prepare the UPDATE query
    $update_query = $conn->prepare("UPDATE CITY SET CITYNAME = ? WHERE CITYID = ?");
    
    // Bind parameters to the query
    $update_query->bind_param('ss', $update_name, $update_ID);

    // Execute the query
    if ($update_query->execute()) {
        // Set a session variable to indicate successful update
        $_SESSION['update_success'] = true;
        header('Location: cityList.php');
        exit;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
    }

    // Close the statement
    $update_query->close();

    // Redirect to cityDetails.php regardless of the outcome
    header('Location: cityDetails.php');
    exit;
}
?>
