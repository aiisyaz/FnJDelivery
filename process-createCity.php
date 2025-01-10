<?php
session_start();
include('../include/config.php');

if (isset($_POST['add'])) {

    $cityName = $_POST['name'];
 

    // Create city ID using Oracle sequence

$city_query = mysqli_query($conn, "SELECT CONCAT('C', LPAD((COALESCE(MAX(SUBSTRING(CITYID, 2)) + 100, 1)), 3, '0')) AS NEXTVAL FROM CITY");




    $city_id_row = mysqli_fetch_assoc($city_query);
    $city_id = $city_id_row['NEXTVAL'];

    // INSERT city details into the device table with prepared statement
    $add_city_query = mysqli_query($conn, "INSERT INTO CITY (cityid, cityname) 
                                        VALUES ('$city_id', '$cityName')");


    if (!$add_city_query) {
        // Handle error and redirect to an error page
        $_SESSION['errorAdd'] = true;
        header('Location: cityList.php');
        exit;
    }
    else {
        // Handle error and redirect to an success page
        $_SESSION['successAdd'] = true;
        header('Location: cityList.php');
        exit;

    }
}
?>
