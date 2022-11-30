<!DOCTYPE html>
<html>
	<head>
		<title>Courier Management System</title>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style>
			*
			{
				margin:0;
				padding:0;
			}
			
			.container
			{
				height:1000px;
				width:1200px;
				margin-top:45px;
				margin-bottom:auto;
				margin-left:auto;
				margin-right:auto;
				border-style: solid;
				border-color: #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			table
			{
				border-collapse: collapse;
				width:1100px;
				margin-bottom:auto;
				margin-left:auto;
				margin-right:auto;
				margin-top:20px;
			}
			
			table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
			}
			
			.container h1
			{
				text-transform:uppercase;
				text-align:center;
				color:#21618C; 
				font-weight:600;
				margin:35px;
			}
			
			.updateButton
			{
				width:100%;
				background-color:#5499C7;
				color:white;
				border:none;
				padding:10px;
				font-size:18px;
			}
			
			.updateButton:hover
			{
				background-color:#2874A6;
			}
			
			button a i
			{
				color :white;
			}
		</style>
		
	</head>
	
	<body>
		<?php
			include("courier_management_system.php");
			session_start();
			include('homepage_header.php');
			
			//Select database from courier
			$sql = "SELECT * FROM courier";
			$result = mysqli_query($combine,$sql);
			$count = mysqli_num_rows($result);
			$i=1;
		?>
		
		<div class = "container">
			<h1>Courier Partner</h1>
			<table>
				<tr>
					<th>No.</th>
					<th>Courier Name</th>
					<th>Email</th>
					<th>Contact Number</th>
					<th>View</th>
				</tr>
				
				<?php 
					while($row = mysqli_fetch_array($result)){
				?>
				<tr>
					<td><?php echo $i++ ?></td>
					<td><?php  echo $row['courierName'];?></td>
					<td><?php  echo $row['courierEmail'];?></td>
					<td><?php  echo $row['courierContactNumber'];?></td>
					<td>
						<?php 
							echo "<button class = 'updateButton'><a href = 'viewCourierPartner.php?viewID=".$row['courierID']."'><i class='bx bx-show' ></i></a></button>";
						?>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
		</div>
		
		<?php
			include('footer.php');
		?>
	</body>
	
</html>