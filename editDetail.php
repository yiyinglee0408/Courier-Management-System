<!DOCTYPE html>
<html>
	<head>
		<title>Edit Parcel Detail Page</title>
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
			
			.container
			{
				height:2950px;
				width:1050px;
				margin:auto;
				margin-top:45px;
				margin-bottom:80px;
				margin-left:340px;
				border-style: solid;
				border-color: #E9ECEF;
				background-color:white;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				background-color:white;
				margin-left:35px;
				padding-bottom:50px;
			}
			
			input[type=text],input[type=tel],input[type=date], select
			{
				width:94%;
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
		
		$courierID = $_SESSION['courierID'];

		if($courierID == '')
		{
			header('location:courier_login.php');
		}
		
		include('courier_sidebar.php');
		include('courier_header.php');
	?>
	
	<body>
	
		<div class = "container">
			<h2 style = "margin-top:25px; margin-left:35px;"><font color = "#21618C">Edit Parcel Detail</font></h2><br>
		<?php	
			echo "<form method = 'GET' action = 'editDetail2.php' enctype='multipart/form-data' class = 'form'>";
				$ID=$_GET['editID'];
				$sql = "SELECT * FROM user_delivery_details WHERE user_delivery_details.deliveryID = '$ID'";
				$result = mysqli_query($combine, $sql); 
				$row= mysqli_fetch_array($result, MYSQLI_ASSOC);

				echo "<h3 style = 'color:#21618C'>Sender Details</h3><br/>";
				echo "<label for = 'fullName'>Full Name</label>";
				echo "<input type = 'text' id = 'fullName' name = 'fullName' placeholder = 'Full Name' value= '".$row['fullName']."'/><br/>";
				
				echo "<label for = 'email'>Email</label>";
				echo "<input type = 'text' id = 'email' name = 'email' placeholder = 'Email' pattern = '[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com' value= '".$row['email']."'/><br/>";
				
				echo "<label for = 'contactNumber'>Contact Number</label>";
				echo "<input type = 'tel' id = 'contactNumber' name = 'contactNumber' placeholder = 'Contact Number' pattern = '[0-9]{3}-[0-9]{7,8}' value= '".$row['contactNumber']."'/><br/>";
				
				echo "<label for = 'autocomplete'>Address</label>";
				echo "<input type = 'text' id = 'autocomplete' name = 'autocomplete' onFocus = 'geolocate()' placeholder = 'Please Enter Address Here...' value= '".$row['autocomplete']."'/><br/>";
				
				echo "<label for = 'apartmentUnit'>Apartment, Unit, Suite, or Floor(Optional)</label>";
				echo "<input type = 'text' id = 'apartmentUnit' name = 'apartmentUnit' placeholder = 'Apartment, Unit, Suite, or Floor(Optional)' value= '".$row['apartmentUnit']."'><br/>	"; 
				
				echo "<label for = 'locality'>City</label>";
				echo "<input type = 'text' id = 'locality' name = 'locality' placeholder='City' value= '".$row['locality']."'><br/>";
				
				echo "<label for = 'administrative_area_level_1'>State</label>";
				echo "<input type = 'text' id = 'administrative_area_level_1' name = 'administrative_area_level_1' placeholder='State' value= '".$row['administrative_area_level_1']."'><br/>";
				
				echo "<label for = 'postal_code'>ZIP Code / Postal Code</label>";
				echo "<input type = 'text' id = 'postal_code' name = 'postal_code' placeholder='ZIP Code / Postal Code' value= '".$row['postal_code']."'><br/>";
				
				echo "<label for = 'country'>Country</label>";
				echo "<input type = 'text' id = 'country' name = 'country' placeholder='Country' value= '".$row['country']."'><br/><br>";
				
				echo "<h3 style = 'color:#21618C'>Receiver Details</h3><br/>";
				
				echo "<label for = 'receiverFullName'>Full Name</label>";
				echo "<input type = 'text' id = 'receiverFullName' name = 'receiverFullName' placeholder = 'Full Name' value= '".$row['receiverFullName']."'/><br/>";
				
				echo "<label for = 'receiverEmail'>Email</label>";
				echo "<input type = 'text' id = 'receiverEmail' name = 'receiverEmail' placeholder = 'Email' pattern = '[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com' value= '".$row['receiverEmail']."'/><br/>";
				
				echo "<label for = 'receiverContactNumber'>Contact Number</label>";
				echo "<input type = 'tel' id = 'receiverContactNumber' name = 'receiverContactNumber' placeholder = 'Contact Number' pattern = '[0-9]{3}-[0-9]{7,8}' value= '".$row['receiverContactNumber']."'/><br/>";
				
				echo "<label for = 'receiverAddress'>Address</label>";
				echo "<input type = 'text' id = 'receiverAddress' name = 'receiverAddress' placeholder = 'Please Enter Address Here...' value= '".$row['receiverAddress']."'/><br/>";
				
				echo "<label for = 'receiverApartmentUnit'>Apartment, Unit, Suite, or Floor(Optional)</label>";
				echo "<input type = 'text' id = 'receiverApartmentUnit' name = 'receiverApartmentUnit' placeholder = 'Apartment, Unit, Suite, or Floor(Optional)' value= '".$row['receiverApartmentUnit']."'/><br/>";
				
				echo "<label for = 'receiverCity'>City</label>";
				echo "<input type = 'text' id = 'receiverCity' name = 'receiverCity' placeholder='City' value= '".$row['receiverCity']."'><br/>";
				
				echo "<label for = 'receiverState'>State</label>";
				echo "<input type = 'text' id = 'receiverState' name = 'receiverState' placeholder='State' value= '".$row['receiverState']."'><br/>";
				
				echo "<label for = 'receiverPostalCode'>ZIP Code / Postal Code</label>";
				echo "<input type = 'text' id = 'receiverPostalCode' name = 'receiverPostalCode' placeholder='ZIP Code / Postal Code' value= '".$row['receiverPostalCode']."'><br/>";
				
				echo "<label for = 'receiverCountry'>Country</label>";
				echo "<input type = 'text' id = 'receiverCountry' name = 'receiverCountry' placeholder='Country' value= '".$row['receiverCountry']."'><br/><br/>";
				
				echo "<h3 style = 'color:#21618C'>Shipment Details</h3><br/>";
				
				echo "<label for = 'parcelWeight'>Parcel Weight(kg)</label><br/>";
				echo "<input type='text' id='parcelWeight' name='parcelWeight' placeholder = 'Eg:1kg' value= '".$row['parcelWeight']."'><br><br>";
				
				echo "<label for = 'parcelContent'>Parcel Content</label><br>";
				echo "<input type = 'text' id = 'parcelContent' name = 'parcelContent' placeholder = 'Eg:Book' value= '".$row['parcelContent']."'><br><br>";

				echo "<br /><br /><input type='submit' name='submit' value='Submit' onClick=\"javascript: return confirm('Are you sure you want to update?');\">";

				echo "<input type = 'hidden' id = 'deliveryID' name = 'deliveryID' value= '".$row['deliveryID']."'/><br>";
				echo "<input type = 'hidden' id = 'userID' name = 'userID' value= '".$row['userID']."'/><br>";
				echo "<input type = 'hidden' id = 'courierID' name = 'courierID' value= '".$row['courierID']."'/><br>";
				echo "<input type = 'hidden' id = 'trackingNumber' name = 'trackingNumber' value= '".$row['trackingNumber']."'/><br>";
				
			echo "</form>";
		?>
		</div>
	
	</body>
	
</html>