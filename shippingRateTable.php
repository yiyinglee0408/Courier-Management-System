<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier Shipping Price List</title>
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
				width:1080px;
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
				width:25%;
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
			
			.button
			{
				display:inline-block;
				width:15%;
				background-color:#2471A3;
				color:white;
				border:none;
				padding:10px;
				font-size:18px;
				float:right;
				font-weight:600;
				border-radius:8px;
				letter-spacing:0.5px
			}
			
			.button:hover
			{
				background-color:#21618C;
			}
			
			.deleteShippingRateButton
			{
				width:25%;
				background-color:red;
				color:white;
				border:none;
				padding:10px;
				font-size:18px;
			}
			
			.deleteShippingRateButton:hover
			{
				background-color:#C0392B;
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
		
		//Select database from shippingrate
		$sql = "SELECT * FROM shippingrate WHERE shippingrate.courierID='$courierID'";
		$result = mysqli_query($combine,$sql);
		$count = mysqli_num_rows($result);
	?>
	
	<h1 style = "color:#21618C; margin-left:330px; padding-top:30px;">Shipping Rate Table</h1><br/>
	<table>
		<tr>
			<th colspan = "3">
				<button class = "button"><a href = "shippingPrice.php">ADD NEW</a></button>
			</th>
		</tr>
		<tr>
			<th>Weight(KG)</th>
			<th>Price(RM)</th>
			<th>Action</th>
		</tr>
		<?php 
			while($row = mysqli_fetch_array($result)){
		?>
		<tr>
			<td>
				<?php echo $row['minWeight']?>
				-
				<?php echo $row['maxWeight']?>
			</td>
			<td><?php echo $row['price'] ?></td>
			<td>
				<?php 
					echo "<button class = 'editShippingRateButton'><a href = 'editDetail.php?editID=".$row['ID']."'><i class='bx bx-edit'></i></a></button>
					<button class = 'deleteShippingRateButton'><a href = 'deleteDetail.php?deleteID=".$row['ID']."'><i class='bx bx-trash'></i></a></button>";
				?>
			</td>
		</tr>
		<?php
			}
		?>
	</table>
	
</html>