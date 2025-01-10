<?php
session_start();
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_type = $_POST['pay'];
    $cust_id = $_POST['custid'];
    $servicedetails_id = $_POST['servicedetails'];
    $total_payment = $_POST['totalPrice'];

    // Process FPX payment
    // Create PAYMENT ID using Oracle sequence
    $payment_id_query = mysqli_query($conn, "SELECT CONCAT('P', LPAD((SELECT COALESCE(MAX(SUBSTRING(PAYMENTID, 2) + 1), 1) FROM PAYMENT), 4, '0')) AS NEXTVAL");
    $payment_id_row = mysqli_fetch_assoc($payment_id_query);
    $payment_id = $payment_id_row['NEXTVAL'];
    $_SESSION['payment_id'] = $payment_id;

    // Insert data into the payment table for FPX payment using prepared statement
    $payment_insert_query = "INSERT INTO payment (paymentid, paymenttotal, paymentmethod, paymentstatus, servicedetailsid) 
                             VALUES (?, ?, ?, 'SUCCESSFUL', ?)";
    $payment_statement = mysqli_prepare($conn, $payment_insert_query);
    mysqli_stmt_bind_param($payment_statement, "sdss", $payment_id, $total_payment, $payment_type, $servicedetails_id);
    $fpx_payment_query = mysqli_stmt_execute($payment_statement);

    // Check for errors during the execution of the query
    if (!$fpx_payment_query) {
        $error_message = mysqli_error($conn);
        echo "Error inserting into payment table: $error_message";
        exit;
    }

    // Insert data into TRACKSERVICE table
    // Create TRACK ID using Oracle sequence
    $track_id_query = mysqli_query($conn, "SELECT CONCAT('T', LPAD((SELECT COALESCE(MAX(SUBSTRING(TRACKID, 2) + 1), 1) FROM TRACKING), 4, '0')) AS NEXTVAL");
    $track_id_row = mysqli_fetch_assoc($track_id_query);
    $track_id = $track_id_row['NEXTVAL'];
    $_SESSION['track_id'] = $track_id;

    // Insert data into TRACKING table using prepared statement
    $track_insert_query = "INSERT INTO TRACKING (TRACKID, TRACKSTATUS, TRACKTIMESTAMP, SERVICEDETAILSID, CUSTOMERID) 
                           VALUES (?, 'PENDING', NOW(), ?, ?)";
    $track_statement = mysqli_prepare($conn, $track_insert_query);
    mysqli_stmt_bind_param($track_statement, "sss", $track_id, $servicedetails_id, $cust_id);
    $track_query = mysqli_stmt_execute($track_statement);

    if (!$track_query) {
        $error_message = mysqli_error($conn);
        echo "Error inserting into TRACKSERVICE table: $error_message";
        exit;
    }

    $_SESSION['successAdd'] = true;
    // Redirect to success page
    header('Location: success_payment.php');
    exit;
} else {
    // Handle other cases if needed
}
?>
