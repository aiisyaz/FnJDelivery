<?php
    session_start();

    if(isset($_GET['delete']))
    {
        include("include/config.php");

        $device_id = $_GET['delete'];
        
        // Check if the device exists
        $query = "SELECT * FROM DEVICE WHERE DEVICEID = '$device_id'";
        $device_result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($device_result);

        if(!$row)
        {
            $_SESSION['deleteError'] = 1;          
            header('Location: view_device.php');
            exit;
        }
        else
        {
            // Update the device status to 'INACTIVE'
            $query2 = "UPDATE DEVICE SET DEVICESTATUS = 'INACTIVE' WHERE DEVICEID = '$device_id'";
            $result2 = mysqli_query($conn, $query2);

            if ($result2)
            {
                $_SESSION['deleteSuccess'] = 1;
                header('Location: view_device.php');
                exit;
            }
            else
            {
                $_SESSION['deleteError'] = 2;
                header('Location: view_device.php');
                exit;
            }
        }
    }
    else
    {
        $_SESSION['deleteError'] = 3;
        header('Location: view_device.php');
        exit;
    }
    
?>
