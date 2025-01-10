<?php
include '../include/config.php';

// Initialize session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Close the MySQLi connection
$conn->close();

// Redirect to admin login page
header("Location: admin_login.php");
exit();
?>
