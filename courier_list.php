<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier List</title>
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
			}
			
			table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
			}
			
			button
			{
				width:45%;
				background-color:#5499C7;
				color:white;
				border:none;
				padding:10px;
				font-size:18px;
			}
			
			button:hover
			{
				background-color:#2874A6;
			}
			
			button a i
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
		
		include('admin_sidebar.php');
		
		$adminID = $_SESSION['adminID'];
	
		if($adminID == '')
		{
			header('location:admin_login.php');
		}
		
		include('header.php');
		
		//Select database from courier
		$sql = "SELECT * FROM courier";
		$result = mysqli_query($combine, $sql);
		$count = mysqli_num_rows($result);
		$i=1;
	?>
	
	<body>
	
		<h1 style = "color:#21618C; margin-left:330px; padding-top:30px;">Courier List</h1><br/>
		
		<table>
			<tr>
				<th>No.</th>
				<th>Courier Name</th>
				<th>Email</th>
				<th>Contact Number</th>
				<th>Action</th>
			</tr>
			
			<?php 
				while($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td><?php echo $i++?></td>
				<td><?php echo $row['courierName']?></td>
				<td><?php echo $row['courierEmail']?></td>
				<td><?php echo $row['courierContactNumber']?></td>
				<td>
					<?php 
						echo "<button><a href = 'viewCourierDetail.php?viewID=".$row['courierID']."'><i class='bx bx-show' ></i></a></button>";
					?>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
	
	</body>
	
</html>