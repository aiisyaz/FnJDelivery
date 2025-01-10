<?php

session_start();
include('../include/config.php');

// Fetch city information based on the provided ID
if (isset($_POST['CITYID'])) {

    // Sanitize input data to prevent SQL injection
    $CITYID = $conn->real_escape_string($_POST['CITYID']);

    $query = "SELECT * FROM CITY WHERE CITYID = '$CITYID'";
    $result = $conn->query($query);

    if ($result) {
        $cityData = $result->fetch_assoc();
        echo json_encode($cityData);
    } else {
        // Log or echo the error
        echo json_encode(['error' => $conn->error]);
    }

    // Close the connection
    $conn->close();
}
?>
