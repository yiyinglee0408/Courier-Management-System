<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier View Customer Request List</title>
		<meta charset = "utf-8">
		
		<style>
			*
			{
				margin:0;
				padding:0;
			}
			
			body
			{
				background-color:#F4F7F9;
			}
			
			table
			{
				border-collapse: collapse;
				width:1150px;
				margin-left:330px;
				margin-top:10px;
				margin-bottom:80px;
			}
			
			table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
			}
			
			.editShippingRateButton
			{
				width:100%;
				background-color:#5DADE2;
				color:white;
				border:none;
				padding:10px;
				font-size:18px;
			}
			
			.editShippingRateButton:hover
			{
				background-color:#21618C;
			}
			
			button a 
			{
				color :white;
			}
			
		</style>
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
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
		
		//Select database from courierexpenses
		$sql = "SELECT * FROM customerservice WHERE customerservice.courierID='$courierID'";
		$result = mysqli_query($combine,$sql);
		$count = mysqli_num_rows($result);
		$i=1;
	?>
	
	<h1 style = "color:#21618C; margin-left:330px; padding-top:30px;">Courier View Customer Request Table</h1><br/>
	
	<table>
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Contact Number</th>
			<th>Tracking Number</th>
			<th>Description</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		
		<?php 
			while($row = mysqli_fetch_array($result)){
		?>
		<tr>
			<td><?php echo $i++ ?></td>
			<td><?php echo $row['fullName']?></td>
			<td><?php echo $row['email'] ?></td>
			<td><?php echo $row['contactNumber']?></td>
			<td><?php echo $row['trackingNumber']?></td>
			<td><?php echo $row['description']?></td>
			<td>
				<?php
					if($row['courierAction'] == '')
					{
						echo "<font color ='red'>NO ACTION</font></td>"; 
					}
					else
					{
						echo $row['courierAction'];
					}
				?>
			</td>
			<td>
				<?php 
					echo "<button class = 'editShippingRateButton'><a href = 'solveCustomerRequest.php?solveID=".$row['ID']."'><i class='bx bx-edit-alt'></i></a></button>";
				?>
			</td>
		</tr>
		<?php
			}
		?>
	</table>