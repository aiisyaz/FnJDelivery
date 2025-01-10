<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['cust_name']);

session_unset(); 

// Delete all session variables
session_destroy();

// Jump to login page
header('Location: ../login/index.php');

?>
