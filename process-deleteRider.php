<?php
    session_start();

    if(isset($_GET['delete']))
    {
        include("../include/config.php");

        $rider_id = $_GET['delete'];
        
        $query = "SELECT * FROM RIDER WHERE RIDER_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $rider_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();ASSOC);

        if(!$row)
        {
            $_SESSION['deleteError'] = 1;          
            print '<script>window.location.assign("riderList.php");</script>';
        }
        else
        {
            $query2 = "DELETE FROM RIDER WHERE RIDER_ID = '$rider_id'";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("s", $rider_id);
            $result2 = $stmt2->execute();

            if ($result2)
            {
                $conn->commit();
                $_SESSION['deleteSuccess'] = 1;
                print '<script>window.location.assign("riderList.php");</script>';
            }
            else
            {
                $_SESSION['deleteError'] = 2;
                print '<script>window.location.assign("riderList.php");</script>';
            }
        }
    }
    else
    {
        $_SESSION['deleteError'] = 3;
        print '<script>window.location.assign("riderList.php");</script>';
    }
    
?>