<!DOCTYPE html>
<html>
	<head>
		<title>User Tracking Parcel Page</title>
		<meta charset = "utf-8">
		
		<style>
		
			*
			{
				margin:0;
				padding:0;
				box-sizing:border-box;
			}
			
			body
			{
				background-color:#F4F7F9;
			}
		
			.container
			{
				height:300px;
				width:1050px;
				margin:auto;
				margin-top:25px;
				margin-bottom:5px;
				margin-left:340px;
				border-style: solid;
				border-color: #E9ECEF;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				background-color:white;
				padding-left:50px;
				padding-top:50px;
				padding-bottom:45px;
			}
			
			input[type=text]
			{
				width:95%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:13%;
				text-transform:uppercase;
				background-color:#2874A6;
				color:white;
				font-weight:600;
				border:none;
				padding:1rem;
				border-radius:8px;
				font-size:15px;
				letter-spacing:0.5px;
				margin-bottom:10px;
			}
			
			input[type=submit]:hover
			{
				background-color:#5499C7;
			}
		
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		
		include('user_sidebar.php');
	?>
	
	<body>
	
		<h1>Tracking Parcel</h1>
	
		<div class = "container">
			
			<form method = "POST" action = "trackParcel.php" class = "form">
			
				<h2 style = "color:#21618C;">Track Parcel</h2><br/>
			
				<label for = "trackingNumber">Tracking Number</label>
				<input type = "text" id = "trackingNumber" name = "trackingNumber" placeholder = "Enter Tracking Number"/><br>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "TRACK" name = "submit"/> 
			</form>
			
		</div>
		
		<table>
			<tr>
				<th>Tracking Number</th>
			</tr>
			
			<tr>
				<td><?php echo $row['trackingNumber']; ?></td>
			</tr>
		<table>
		
		https://stackoverflow.com/questions/49346255/i-want-my-button-to-change-the-status-set-but-instead-of-changing-it-goes-to-a
	
	</body>
	
</html>