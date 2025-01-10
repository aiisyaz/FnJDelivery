<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../include/config.php');

    $fee = $_POST['serviceFee'];
    $ID = $_POST['serviceID'];

   
    // Sanitize input data to prevent SQL injection
    $fee = mysqli_real_escape_string($conn, $fee);
    $ID = mysqli_real_escape_string($conn, $ID);

    $query = "SELECT * FROM SERVICE WHERE SERVICEID = '$ID'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $_SESSION['update_failure'] = 1;
        mysqli_close($conn);
        header("Location: serviceList.php");
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    if ($fee == $row['SERVICEPRICE']) {
        $_SESSION['update_failure'] = 3;
        mysqli_close($conn);
        header("Location: serviceList.php");
        exit();
    } else {
        $query2 = "UPDATE SERVICE SET SERVICEPRICE='$fee' WHERE SERVICEID='$ID'";
        $result2 = mysqli_query($conn, $query2);

        if ($result2) {
            $_SESSION['update_success'] = 1;
            echo "update success";
            mysqli_close($conn);
            header("Location: serviceList.php");
            exit();
        } else {
            $_SESSION['update_failure'] = 2;
            echo "update fail";
            mysqli_close($conn);
            header("Location: serviceList.php");
            exit();
        }
    }
} else {
    $_SESSION['update_failure'] = 3;
    header("Location: serviceList.php");
    exit();
}
?>
