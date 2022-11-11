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
	
	$ID=$_GET['deleteID'];
	$query = "DELETE FROM user_delivery_details WHERE deliveryID='$ID'";
	
	$data=mysqli_query($combine,$query);
	
	if ($data)
	{
		echo"<script>alert('Sucessfully delete!');
		window.location='parcelList.php'</script>";
	}
	else
	{
		echo"<script>alert('Not sucessfully delete!');
		window.location='parcelList.php'</script>";
	}
?>