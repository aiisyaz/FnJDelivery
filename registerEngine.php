<?php
session_start();

include('../include/config.php');

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['Phone_No'];
    $Cpass = $_POST['Password'];

    $select_users = mysqli_query($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMERID = '$id'");

    if (mysqli_fetch_assoc($select_users)) {
        $error_message = "User with this ID already exists. Please choose a different ID or sign in.";
        header("Location: Register.php?error_message=" . urlencode($error_message));
        exit();
    } else {
        $insert_query = mysqli_prepare($conn, "INSERT INTO CUSTOMER (CUSTOMERID, CUSTOMERNAME, CUSTOMERPHONENUMBER, CUSTOMEREMAIL, CUSTOMERPASSWORD) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_query, "sssss", $id, $name, $phoneNumber, $email, $Cpass);
        mysqli_stmt_execute($insert_query);
        if ($insert_query) {
            header('Location: ../login/index.php');
            exit();
        } else {
            $error_message = "Error occurred during signup. Please try again later.";
            header("Location: Register.php?error_message=" . urlencode($error_message));
            exit();
        }
    }
}

?>
