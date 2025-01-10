<?php
include('include/config.php');

session_start();

$cust_id = $_SESSION['cust_id'];
$cust_name = $_SESSION['cust_name'];

if (!isset($cust_id)) {
    header('location: login/process.php');
    exit;
}

// Check for update success or failure messages
$updateSuccess = isset($_SESSION['update_success']) && $_SESSION['update_success'];
$updateFailure = isset($_SESSION['update_failure']) && $_SESSION['update_failure'];
$passwordFailure = isset($_SESSION['password_failure']) && $_SESSION['password_failure'];

if ($updateSuccess) {
    unset($_SESSION['update_success']); 
}

if (isset($_POST['update_profile'])) {
    $update_email = $_POST['update_email'];
    $update_name = $_POST['update_name'];
    $update_phoneNum = $_POST['update_phoneNum'];
    $update_address = $_POST['update_address'];
    $update_ID = $_POST['update_ID'];

    $stmt = $conn->prepare("UPDATE CUSTOMER SET CUSTOMERNAME = ?, CUSTOMERPHONENUMBER = ?, CUSTOMEREMAIL = ? WHERE CUSTOMERID = ?");
    $stmt->bind_param("ssss", $update_name, $update_phoneNum, $update_email, $update_ID);

    if ($stmt->execute()) {

        $_SESSION['cust_id'] = $update_ID;
        $_SESSION['cust_name'] = $update_name;
        
        $_SESSION['update_success'] = true;
        header('location: showProfile.php');
        exit;
    } else {

        $_SESSION['update_failure'] = true;
    }

    header('location: showProfile.php');
    exit;
}

if (isset($_POST['update_password'])) {
    $old_password = $_POST['old_password'];
    $update_password = $_POST['update_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate if passwords match and old password is correct
    $password_check_query = "SELECT CUSTOMER_PASSWORD FROM customer WHERE CUSTOMER_ID = '$cust_id'";
    $result = mysqli_query($conn, $password_check_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['CUSTOMER_PASSWORD'];

        if (!password_verify($old_password, $stored_password)) {
            // Set a session variable to indicate password failure
            $_SESSION['password_failure'] = true;
            header('location: showProfile.php');
            exit;
        }

        if ($update_password !== $confirm_password) {
            // Set a session variable to indicate password failure
            $_SESSION['password_failure'] = true;
            header('location: showProfile.php');
            exit;
        }

        // Hash the new password
        $hashed_password = password_hash($update_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_password_query = "UPDATE CUSTOMER SET CUSTOMER_PASSWORD = '$hashed_password' WHERE CUSTOMER_ID = '$cust_id'";
        $update_result = mysqli_query($conn, $update_password_query);

        if ($update_result) {
            unset($_SESSION['password_failure']);
            header('location: showProfile.php');
            exit;
        } else {
            // Set a session variable to indicate password failure
            $_SESSION['password_failure'] = true;
            header('location: showProfile.php');
            exit;
        }
    } else {
        // Set a session variable to indicate password failure
        $_SESSION['password_failure'] = true;
        header('location: showProfile.php');
        exit;
    }
}
?>
