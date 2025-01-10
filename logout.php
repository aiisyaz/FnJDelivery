<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['staff_name']);

session_unset(); 

// Delete all session variables
session_destroy();

// Jump to login page
header('Location: admin_login.php');

?>
