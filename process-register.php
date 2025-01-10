<?php
session_start();

// Include MySQL database connection settings
include('../include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<?php
if (isset($_POST['signup'])) {
    $name = $_POST['rider_name'];
    $id = $_POST['rider_id'];
    $email = $_POST['rider_email'];
    $phoneNumber = $_POST['phoneNumber'];
    $Cpass = $_POST['password'];

    $select_users = mysqli_query($conn, "SELECT * FROM STAFF WHERE STAFFID = '$id'");

    if (mysqli_fetch_assoc($select_users)) {
        $error_message = "User with this ID already exists. Please choose a different ID or login.";
        header("Location: rider_register.php?error_message=" . urlencode($error_message));
        exit();
    } else {
        // Hash the password before storing
        $hashed_password = password_hash($Cpass, PASSWORD_DEFAULT);
        // Prepare insert query to add new user
        $insert_query = "INSERT INTO STAFF(STAFFID, STAFFNAME, STAFFPHONENUM, STAFFEMAIL, STAFFPASSWORD, STAFFSTATUS, STAFFROLE) VALUES(?, ?, ?, ?, ?, 'ACTIVE', 'RIDER')";
        $stmt_insert = $conn->prepare($insert_query);
        $stmt_insert->bind_param("sssss", $id, $name, $phoneNumber, $email, $Cpass);
        $stmt_insert->execute();
        $stmt_insert->close();
        header('Location:admin_login.php');
        exit();
    }
}

// Close the MySQL connection
$conn->close();
?>
</body>
</html>
