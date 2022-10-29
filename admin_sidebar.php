<!DOCTYPE html>
<html>
	<head>
	
		<title>Sidebar Menu</title>
		<meta charset = "utf-8">
		
		<style>
		
			*
			{
				margin:0;
				padding:0;
				list-style:none;
				text-decoration:none;
			}
		
			.sidebar
			{
				position:fixed;
				left:0px;
				height:100%;
				width:250px;
				background:#283747;
				padding:6px 14px;
				transition:all .5s ease;
			}
			
			.sidebar h1
			{
				font-size:22px;
				color:white;
				line-height:70px;
				text-align:center;
				user-select:none;
			}
			
			.sidebar ul a
			{
				display:block;
				height:100%;
				width:100%;
				line-height:65px;
				font-size:20px;
				color:white;
				padding-left:10px;
				box-sizing:border-box;
				border-top: 1px solid rgba(255,255,255,.1);
				border-bottom:1px solid black;
				transition:.4s;
			}
			
			ul li:hover a
			{
				padding-left:50px;
			}
			
			.sidebar ul a i
			{
				margin-right:16px;
			}
			
		</style>
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	</head>
	
	<body>

		<div class = "sidebar">
		
			<h1>ADMIN PANEL</h1>
			
			<ul>
			
				<li><a href="#"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
				<li><a href="courierAddressList.php"><i class='bx bx-current-location'></i>Courier Address</a></li>
				<li><a href="parcelList.php"><i class='bx bxs-package'></i>Parcel List</a></li>
				<li><a href="#"><i class='bx bx-search'></i>Track Parcel</a></li>
				<li><a href="#"><i class='bx bxs-report'></i>Report</a></li>
				
				<li><a href="admin_logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
			
			</ul>
		
		</div>
	
	</body>

</html>