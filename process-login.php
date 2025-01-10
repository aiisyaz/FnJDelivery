<?php
// Initialize session
session_start();

if (isset($_POST['login'])) {
    // Include database connection settings
    include('../include/config.php');

    // Capture values from HTML form
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Query to check login credentials
    $sql = "SELECT * FROM STAFF WHERE STAFFID = '$id' AND STAFFPASSWORD = '$password'";
    $query = mysqli_query($conn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);

    if (!$row) {
        // Invalid login, set error message
        $error_message = "Invalid ID or password. Please try again.";
        header("Location: admin_login.php?error_message=$error_message");
    } else {
        // Valid login
        $r = mysqli_fetch_assoc($query);

            // Set session variables
            $_SESSION['staff_id'] = $r['STAFFID'];
            $_SESSION['staff_name'] = $r['STAFFNAME'];
            
            // Redirect based on staff role
            if ($r['STAFFROLE'] == "ADMIN") {
                header('Location: admin_index.php');
            } else {
                header('Location: rider_index.php');
            }

    }

} else {
    // Redirect to login page if login form is not submitted
    header('Location: admin_login.php');
}
?>
