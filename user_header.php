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
			}
			
			header
			{
				background:#34495E;
				height:77px;
			}
			
			.right-nav h4
			{
				color:white;
				margin-top:25px;
				margin-right:30px;
				cursor:pointer;
			}

		</style>
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
	
		<header>
		
			<ul class = "right-nav">
			
				<?php
					$userID=$_SESSION['userID'];
					$result=mysqli_query($combine,"SELECT fullName from user WHERE userID='$userID'");
					$row=mysqli_fetch_array($result);
					$fullName=$row['fullName'];
					
					if(isset($_SESSION['userID']))
					{
						echo "<a href='user_profile.php'>";
						echo "<h4><i class='bx bxs-user-circle'></i> $fullName</h4>";
						echo "</a>";
					}
				?>
			
			</ul>
		
		</header>
	
	</body>

</html>