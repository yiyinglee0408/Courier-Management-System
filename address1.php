<!DOCTYPE html>
<html>
	<head>
		<title>Autocomplete Address Page</title>
		<meta charset = "utf-8">
	</head>
	
	<body>
	
		<form method = "POST" action = "address1.php">
			 <input type = "text" id = "autocomplete" name = "autocomplete" onFocus = "geolocate()" placeholder = "Please enter address here..."/>
			 <!--<input id="street_number" disabled="true" placeholder="Street address">-->
			 <input type = "text" id = "address2" name = "address2" placeholder = "Apartment, unit, suite, or floor">		 
			 <input class="form-control" id="route" disabled="true" placeholder="Route">
			 <input class="form-control field" id="locality" disabled="true" placeholder="City">
			 <input class="form-control" id="administrative_area_level_1" disabled="true" placeholder="State">
			 <input class="form-control" id="postal_code" disabled="true" placeholder="ZIP Code">
			 <input class="form-control" id="country" disabled="true" placeholder="Country">
		</form>
		
	</body>
</html>