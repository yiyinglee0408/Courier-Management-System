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
			  position: relative;
			  text-align: center;
			  color:white;
			}
			
			.container1
			{
				display : flex;
				justify-content : center;
				align-items : center;
				height:300px;
				width: 1200px;
				margin:auto;
				margin-top: 20px;
				margin-bottom:80px;
			}
			
			.container2
			{
				display:flex;
				height:408px;
				width: 1200px;
				margin:auto;
				margin-top: 50px;
				margin-bottom:50px;
			}
			
			.container3
			{
				display:flex;
				height:130px;
				max-width: 1200px;
				margin:0 auto;
				margin-bottom:50px;
			}
			
			input[type=submit]:hover
			{
				background-color:#5499C7;
			}
			
			.trackParcel
			{
				position: absolute;
				font-weight:600; 
				font-size:350%;
				top: 35%;
				left: 58%;
			}
			
			.trackButton button
			{
				position: absolute;
				top: 48%;
				left: 63.5%;
				display:inline-block;
				width:20%;
				text-transform:uppercase;
				background-color:#2874A6;
				color:white;
				font-weight:600;
				border:none;
				padding:1rem;
				border-radius:8px;
				font-size:15px;
				letter-spacing:0.5px;
				margin: 0;
			}
			
			.trackButton button:hover
			{
				background-color:#5499C7;
			}
			
			.trackButton button a
			{
				text-decoration: none;
				color:white;
			}
			
			.aboutH1
			{
				margin-top:35px;
				margin-left: 40px; 
			}
			
			.content1
			{
				position : relative;
				width :  28%;
				height : 300px;
				padding : 0 15px;
				box-sizing : border-box;
				margin : 10px;
				border-style: solid;
				border-color: #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			.content2
			{
				position : relative;
				width :  28%;
				height : 300px;
				padding : 0 15px;
				box-sizing : border-box;
				margin : 10px;
				border-style: solid;
				border-color: #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			.content3
			{
				position : relative;
				width :  28%;
				height : 300px;
				padding : 0 15px;
				box-sizing : border-box;
				margin : 10px;
				border-style: solid;
				border-color: #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			.content4
			{
				position : relative;
				width :  28%;
				height : 300px;
				padding : 0 15px;
				box-sizing : border-box;
				margin : 10px;
				border-style: solid;
				border-color: #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			.icon
			{
				width : 60px;
				height : 60px;
				background : #34495E;
				border-radius : 50%;
				margin : 10% auto ;
			}
			
			.icon i
			{
				font-size : 30px;
				padding : 15px;
				color : white;
			}
		</style>
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel = "stylesheet" type = "text/css" href= "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
		<link rel = "stylesheet" type = "text/css" href= "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
	</head>
	
	<body>
	
		<?php
			include('homepage_header.php');
		?>
	
		<div class = "container">
			<img src = "image/h2.jpg" alt = "Homepage" style="width:100%;">
			
			<!--<h1>Track Parcel Status</h1></img>-->
			<div class="trackParcel">Track Parcel Status</div><br>
			<div class = "trackButton"><button><a href = "trackParcel_homepage.php">Track Now</a></button></div>
		</div>
		
		<center><h1 style= "color:#21618C; font-weight:600; font-size:50px; margin-top:50px;">Follow Simple Step</h1><center>
		<div class = "container1">
			
			<div class = "content1">
				<div class = "icon">
					<i class='bx bxs-user-account'></i>
				</div>
				
				<h3>Login or Register</h3>
				
				<p style="margin-top:20px; font-weight:300; text-align:center;line-height:1.5;">Consumers need to login or register account to fill in the information of the parcel.</p>
			</div>
			
			<div class = "content2">
				<div class = "icon">
					<i class='bx bx-notepad'></i>
				</div>
				
				<h3>Fill the Form</h3>
				
				<p style="margin-top:20px; font-weight:300; text-align:center;line-height:1.5;">Consumers fill in sender and receiver information, select courier company to delivery parcel and select payment method.</p>
			</div>
			
			<div class = "content3">
				<div class = "icon">
					<i class='bx bx-package' ></i>
				</div>
				
				<h3>Courier Company Collect</h3>
				
				<p style="margin-top:20px; font-weight:300; text-align:center;line-height:1.5;">The courier company will collect the parcel and update the consumers latest parcel status. The courier company is based on the consumers' selections.</p>
			</div>
			
			<div class = "content4">
				<div class = "icon">
					<i class='bx bxs-truck'></i>
				</div>
				
				<h3>Delivery</h3>
				
				<p style="margin-top:20px; font-weight:300; text-align:center;line-height:1.5;">Our reliable courier company enables fastest and most dependable door-to-door transit service in the industry.</p>
			</div>
		</div>
		
		<div class = "container2">
			<div class = "image">
				<img src = "image/about.jpg" alt = "About Us">
			</div>	
			
			<div class = "aboutH1">
				<h1 style= "color:#21618C; font-weight:600; font-size:50px; float:left;">About Us</h1><br><br><br>
				<p style="margin-top:20px; font-weight:300; text-align: justify; margin-right:40px;line-height:2.0;">Courier Management System, situated at Penang,
				Malaysia. This system enables consumers in Penang, Malaysia to select a courier service (such as J&T, Ninjavan, and others)
				that has registered in this system to deliver parcels to third parties and enable consumers to track the parcels.
				we are one of the centralize prominent courier service companies offering an array of services, in a wide network, 
				that covers a number of locations. We are committed to offer fast, reliable and on-time deliveries of your parcels. 
				We specialize in the rapid, cost-effective and reliable delivery of parcels with active customer support.</p>
			</div>
		</div>
		
		<center><h1 style= "color:#21618C; font-weight:600; font-size:50px; margin-top:80px;">Courier Partner</h1><center>
		<div class = "container3">
			<div class = "item"><img src = "image/j&t.png" alt= "J&T" width="200px" height="50px" style = "margin-top:40px;"></div>
			<div class = "item"><img src = "image/ninjavan.png" alt= "J&T" width="200px" height="110px" style = "margin-top:10px;"></div>
			<div class = "item"><img src = "image/poslaju.png" alt= "J&T" width="200px" height="110px" style = "margin-top:10px;"></div>
			<div class = "item"><img src = "image/skynet.png" alt= "J&T" width="200px" height="110px" style = "margin-top:10px;"></div>
		</div>
		
		
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
		<script>
			$('.container3').slick({
			  infinite: true,
			  slidesToShow: 3,
			  slidesToScroll: 3,
			  dots:true
			});
		</script>
		
		<?php
			include('footer.php');
		?>
	</body>
</html>