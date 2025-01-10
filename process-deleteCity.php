<?php
    session_start();

    if(isset($_GET['CITYID']))
    {
        include("../include/config.php");

        $cityid = $_GET['CITYID'];
        
        $query = "SELECT * FROM CITY WHERE CITYID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $cityid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(!$row)
        {
            $_SESSION['deleteError'] = 1;          
            print '<script>window.location.assign("cityList.php");</script>';
        }
        else
        {
            $query2 = "DELETE FROM CITY WHERE CITYID = ?";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("s", $cityid);
            $result2 = $stmt2->execute();

            if ($result2)
            {
                $conn->commit();
                $_SESSION['deleteSuccess'] = 1;
                print '<script>window.location.assign("cityList.php");</script>';
            }
            else
            {
                $_SESSION['deleteError'] = 2;
                print '<script>window.location.assign("cityList.php");</script>';
            }
        }
    }
    else
    {
        $_SESSION['deleteError'] = 3;
        print '<script>window.location.assign("cityList.php");</script>';
    }
$stmt->close();
if (isset($stmt2)) {
        $stmt2->close();
    }
$conn->close();

    
?>