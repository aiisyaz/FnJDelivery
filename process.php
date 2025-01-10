<?php
// Inialize session
session_start();

// Include database connection settings
include('../include/config.php');


if(isset($_POST['login'])){
	
	//capture values from HTML form 
	$id = $_POST['id'];
	$password = $_POST['password'];
	
	$sql= "SELECT * FROM customer WHERE CUSTOMERID = '$id' AND CUSTOMERPASSWORD = '$password'";
	$query = mysqli_query($conn, $sql) or die ("Error: " . mysqli_error());
	$row = mysqli_num_rows($query);
	if($row == 0){
	 // Jump to indexwrong page
	header('Location: indexwrong.php'); 
	}
	else{
	 $r = mysqli_fetch_assoc($query);
	 $id= $r['CUSTOMERID'];
	 $name = $r['CUSTOMERNAME'];
	 $_SESSION ['cust_id'] = $id;
	 $_SESSION['cust_name'] = $name;
	 //$password= $r['password'];
	 
	header('Location: ../createRequest.php');	
	}	
}
else {
	header('Location:index.php');

}
mysqli_close($conn);
?>