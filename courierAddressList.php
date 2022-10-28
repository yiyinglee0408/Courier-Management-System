<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier Address List</title>
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
				margin-top:20px;
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
				width:60%;
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
			
			.addNew
			{
				display:inline-block;
				width:12%;
				text-transform:uppercase;
				background-color:#2874A6;
				color:white;
				font-weight:600;
				border:none;
				padding:10px;
				border-radius:8px;
				font-size:15px;
				letter-spacing:0.5px;
			}
			
			.addNew:hover
			{
				background-color:#5499C7;
				#5499C7
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
		
		//Select database from courieraddress	
		$sql = "SELECT * FROM courieraddress";
		$result = mysqli_query($combine,$sql);
		$count = mysqli_num_rows($result);
		$i=1;
		
		include('admin_sidebar.php');
	?>
	
	<body>
		<h1 style = "color:#21618C; margin-left:330px; padding-top:22px;">Courier Address List</h1><br/>
		
		<table>
			<tr>
				<th colspan = "4">
					<button class = "addNew" style = "float:right"><a href = "addCourierAddress.php" style = "color:white">ADD NEW</a></button>
				</th>
			</tr>
			<tr>
				<th>No.</th>
				<th>Courier Address Name</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
			
			<?php
				while($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td><?php echo $i++ ?></td>
				<td><?php echo $row['addressName'] ?></td>
				<td><?php echo $row['autocomplete'] ?></td>
				<td>
					<?php 
						echo "<button><a href = 'viewAddressDetail.php?updateID=".$row['ID']."'><i class='bx bx-show' ></i></a></button>";
					?>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
	</body>
	
</html>