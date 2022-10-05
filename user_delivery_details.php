<!DOCTYPE html>
<html>
	<head>
		<title>User Delivery Details Page</title>
		<meta charset = "utf-8">
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		
		$sql="SELECT * FROM user";
		$result=mysqli_query($combine,$sql);
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
	?>
	
	<body>
	
		<div class = "container">
		
			<p>Sender Address</p>
			
			<form method = "POST" action = "user_delivery_details.php">
				
				<input type = "text" id = "fullName" name = "fullName" placeholder = "Full Name" value= "<?php echo $row["fullName"]; ?>"/>
				
				<input type = "text" id = "email" name = "email" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php echo $row["email"]; ?>"/>
				
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php echo $row["contactNumber"]; ?>"/>
				
				<input type = "text" id = "autocomplete" name = "autocomplete" onFocus = "geolocate()" placeholder = "Please Enter Address Here..." value= "<?php echo $row["autocomplete"]; ?>"/>
				<!--<input id="street_number" disabled="true" placeholder="Street address">-->
				<input type = "text" id = "apartmentUnit" name = "apartmentUnit" placeholder = "Apartment, Unit, Suite, or Floor(Optional)" value= "<?php echo $row["apartmentUnit"]; ?>">		 
				<!--<input class="form-control" id="route" disabled="true" placeholder="Route">-->
				<input type = "text" id = "locality" name = "locality" placeholder="City" value= "<?php echo $row["locality"]; ?>">
				
				<input type = "text" id = "administrative_area_level_1" name = "administrative_area_level_1" placeholder="State" value= "<?php echo $row["administrative_area_level_1"]; ?>">
				
				<input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code / Postal Code" value= "<?php echo $row["postal_code"]; ?>">
				
				<input type = "text" id = "country" name = "country" placeholder="Country" value= "<?php echo $row["country"]; ?>">
				
				<input type="submit" name="submit" value="SUBMIT">
				<input type="hidden" name="submitted" value="true"/>
			
			</form>
		
		</div>
	
	</body>
</html>