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
    // Capture form data
    $update_email = $_POST['update_email'];
    $update_name = $_POST['update_name'];
    $update_phoneNumber = $_POST['update_phoneNumber'];
    $update_status = $_POST['update_status'];
    $update_ID = $_POST['update_ID'];

    // Prepare and execute the update query
    $update_query = $conn->prepare("UPDATE STAFF SET STAFFNAME = ?, STAFFPHONENUM = ?, STAFFEMAIL = ?, STAFFSTATUS = ? WHERE STAFFID = ?");
    $update_query->bind_param("sssss", $update_name, $update_phoneNumber, $update_email, $update_status, $update_ID);

    if ($update_query->execute()) {
        // Set a session variable to indicate successful update
        $_SESSION['update_success'] = true;
        header('Location: riderList.php');
        exit;
    } else {
        // Set a session variable to indicate failure
        $_SESSION['update_failure'] = true;
    }

    // Redirect regardless of the outcome
    header('Location: riderDetails.php');
    exit;
}
?>
