<?php
	include("courier_management_system.php");
	session_start();
	
	$courierID = $_SESSION['courierID'];

	if($courierID == '')
	{
		header('location:courier_login.php');
	}
	
	include('courier_sidebar.php');
	include('courier_header.php');
	
	$ID=$_GET['deliveryID'];
	$userID=$_GET['userID'];
	$courierID=$_GET['courierID'];
	$trackingNumber=$_GET['trackingNumber'];
	$fullName=$_GET['fullName'];
	$email = $_GET['email'];
	$contactNumber = $_GET['contactNumber'];
	$autocomplete = $_GET['autocomplete'];
	$apartmentUnit = $_GET['apartmentUnit'];
	$locality = $_GET['locality'];
	$administrative_area_level_1 = $_GET['administrative_area_level_1'];
	$postal_code = $_GET['postal_code'];
	$country = $_GET['country'];
	$receiverFullName = $_GET['receiverFullName'];
	$receiverEmail = $_GET['receiverEmail'];
	$receiverContactNumber = $_GET['receiverContactNumber'];
	$receiverAddress = $_GET['receiverAddress'];
	$receiverApartmentUnit = $_GET['receiverApartmentUnit'];
	$receiverCity = $_GET['receiverCity'];
	$receiverState = $_GET['receiverState'];
	$receiverPostalCode = $_GET['receiverPostalCode'];
	$receiverCountry = $_GET['receiverCountry'];
	$parcelWeight = $_GET['parcelWeight'];
	$parcelContent = $_GET['parcelContent'];
	
	$sql = "SELECT * FROM user_delivery_details WHERE user_delivery_details.deliveryID = '$ID'";
	$result = mysqli_query($combine, $sql);
	$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	//edit user profile 
	$sqlEditing="UPDATE `user_delivery_details` SET `fullName`='$fullName',`email`='$email',
	`contactNumber`='$contactNumber',`autocomplete`='$autocomplete',`apartmentUnit`='$apartmentUnit',`locality`='$locality', 
	`administrative_area_level_1`='$administrative_area_level_1', `postal_code`='$postal_code', `country`='$country',
	`receiverFullName`='$receiverFullName', `receiverEmail`='$receiverEmail', `receiverContactNumber`='$receiverContactNumber',
	`receiverAddress`='$receiverAddress', `receiverApartmentUnit`='$receiverApartmentUnit', `receiverCity`='$receiverCity',
	`receiverState`='$receiverState', `receiverPostalCode`='$receiverPostalCode', `receiverCountry`='$receiverCountry', `parcelWeight`='$parcelWeight', `parcelContent`='$parcelContent'
	WHERE `user_delivery_details`.`deliveryID`='$ID' AND `user_delivery_details`.`trackingNumber`='$trackingNumber'";
		
		//successful edited
		if($combine->query($sqlEditing)===TRUE){
			
			echo"<script>alert('Edit Successfully!');
			window.location='parcelList.php'</script>";
		}else{
			//fail edit
			echo "<script>alert('Not successfully edited!');
			window.location='parcelList.php'</script>";
			
		}	
		
	
?>
	