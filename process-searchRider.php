<?php
session_start();

include('../include/config.php');

// Handle the search functionality
if (isset($_GET['search_item'])) {
    $search_item = $_GET['search_item'];

    // Use SQL query to search for riders
    $search_query = "SELECT * FROM RIDER WHERE RIDER_ID LIKE '{$search_item}%' OR RIDER_NAME LIKE '{$search_item}%'";
    $search_statement = $conn->query($search_query);
} else {
    // If no search parameter, retrieve all riders
    $query = "SELECT * FROM RIDER";
    $search_statement = $conn->query($query);
}

?>
