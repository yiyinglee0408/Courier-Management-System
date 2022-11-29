<!DOCTYPE html>
<html>

	<head>
		<title>Courier Management System</title>
		<meta charset = "utf-8">
		
		<style>
			
			ul li 
			{
				list-style-type: none;
			}

			.right-nav
			{
				float: right;
			}

			.right-nav li
			{
				display: inline-block;
				margin: 10px;
				margin-top:25px;
			}
			
			header
			{
				background:#34495E;
				height:77px;
			}
			
			.right-nav li a
			{
				color:white;
				margin-top:50px;
				margin-right:30px;
				cursor:pointer;
				text-decoration: none;
			}


		</style>
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
	
		<header>
		
			<ul class = "right-nav">
				<li><a href = "homepage.php">Home</a></li>
				<li><a href = "courierList.php">Courier Company</a></li>
				<li><a href = "trackParcel_homepage.php">Tracking Parcel</a></li>
				<li><a href = "customerService.php">Customer Service</a></li>
				<li><a href = "feedback.php">Feedback</a></li>
				<li><a href = "login.php">Login</a></li>
				<li><a href = "register.php">Register</a></li>
			
			</ul>
		
		</header>
	
	</body>

</html>