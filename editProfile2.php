<?php
	include("courier_management_system.php");
	session_start();
	
	//took record base on the userID
	$userID = $_SESSION['userID'];
	
	if($userID == '')
	{
		header('location:login.php');
	}
	
	include('user_sidebar.php');
	include('user_header.php');
	
	$fullName =  $_GET['fullName'];
	$email    =  $_GET['email'];
	$contactNumber = $_GET['contactNumber'];
	$autocomplete = $_GET['autocomplete'];
	$apartmentUnit = $_GET['apartmentUnit'];
	$locality = $_GET['locality'];
	$administrative_area_level_1 = $_GET['administrative_area_level_1'];	
	$postal_code =  $_GET['postal_code'];
	$country = $_GET['country'];
	
	//select record base on the session username
	$sql = "SELECT * FROM user WHERE userID = '$userID'";
	$result = mysqli_query($combine, $sql);
	$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	//edit user profile 
	$sqlEditing="UPDATE `user` SET `fullName`='$fullName',`email`='$email',
	`contactNumber`='$contactNumber',`autocomplete`='$autocomplete',`apartmentUnit`='$apartmentUnit',`locality`='$locality', `administrative_area_level_1`='$administrative_area_level_1', `postal_code`='$postal_code', `country`='$country' WHERE `user`.`userID`='$userID'";
		
		//successful edited
		if($combine->query($sqlEditing)===TRUE){
			
			echo"<script>alert('User profile successfully edited!');
			window.location='user_profile.php'</script>";
		}else{
			//fail edit
			echo "<script>alert('Stock not successfully edited!');
			window.location='user_profile.php'</script>";
			
		}	
?>