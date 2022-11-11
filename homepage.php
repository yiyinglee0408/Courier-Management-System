<!DOCTYPE html>
<html>
	<head>
		<title>Courier Management System</title>
		<meta charset = "utf-8">
		
		<style>
			*
			{
				margin:0;
				padding:0;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:70%;
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
			
			.form
			{
				display:flex;
				flex-direction:column;
				background-color:white;
				padding-left:50px;
				padding-top:45px;
				padding-bottom:45px;
			}
			
			input[type=text]
			{
				width:70%;
				border:1px solid grey;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
		</style>
	</head>
	
	<body>
	
		<?php
			include('homepage_header.php');
		?>
	
		<img src = "image/homepage.jpeg" alt = "Homepage" width = "1473px" height = "530"><br><br>
		
		<form method = "POST" action = "trackingParcel.php" class = "form">
			<center><h1 style="text-transform:uppercase; text-align:center; color:#21618C; font-weight:600; font-size:250%;">TRACK PARCEL STATUS</h1><center><br>
			<h3 style = "font-weight:600; padding-right:520px">Enter tracking number to track your parcel current status :</h3><br>
			<input type = "text" id = "trackingNumber" name = "trackingNumber" placeholder = "Enter Your Tracking Number"/><br><br>
			<input type = "hidden" name = "submitted" value = "true"/>
			<input type = "submit" value = "TRACK NOW" name = "submit"/> 
		</form><br><br>
		
		<center><h1 style="text-transform:uppercase; margin-top:45px; text-align:center; color:#21618C; font-weight:600; font-size:250%;">ABOUT US</h1><center><br>
	</body>
</html>