<!DOCTYPE html>
<html>
	<head>
		<title>User Edit Profile Page</title>
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
				height:1100px;
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
				padding-left:50px;
				padding-top:50px;
				padding-bottom:50px;
			}
			
			input[type=text], input[type=email], input[type=tel]
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
				width:40%;
				text-transform:uppercase;
				background-color:#2874A6;
				color:white;
				font-weight:600;
				border:none;
				padding:1rem;
				border-radius:8px;
				font-size:15px;
				letter-spacing:0.5px;
				margin-bottom:20px;
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
		
		//took record base on the userID
		$userID = $_SESSION['userID'];
		
		if($userID == '')
		{
			header('location:login.php');
		}
		
		include('user_sidebar.php');
		include('user_header.php');
		
		//select record base on the session username
		$sql = "SELECT * FROM user WHERE userID = '$userID'";
		$result = mysqli_query($combine, $sql);
		$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
	?>
	
	<body>
	
		<div class = "container">
		<?php
			echo "<form method = 'GET' action = 'editProfile2.php' class = 'form' enctype='multipart/form-data'>";
			echo "<h2><font color = '#21618C'>Edit Profile Detail</font></h2><br>";
				
				echo "<label for = 'fullName'>Full Name</label>";
				echo "<input type = 'text' id = 'fullName' name = 'fullName' placeholder = 'Full Name' value= '".$row['fullName']."';/><br>";
				
				echo "<label for = 'email'>Email</label>";
				echo "<input type = 'text' id = 'email' name = 'email' placeholder = 'Email' pattern = '[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com' value='".$row['email']."'/><br>";
				
				echo "<label for = 'contactNumber'>Contact Number</label>";
				echo "<input type = 'tel' id = 'contactNumber' name = 'contactNumber' placeholder = 'Contact Number' pattern = '[0-9]{3}-[0-9]{7,8}' value= '".$row['contactNumber']."'/><br>";
				
				echo "<label for = 'autocomplete'>Address</label>";
				echo "<input type = 'text' id = 'autocomplete' name = 'autocomplete' onFocus = 'geolocate()' placeholder = 'Please Enter Address Here...' value= '".$row['autocomplete']."'/><br>";
				
				echo "<label for = 'apartmentUnit'>Apartment, Unit, Suite, or Floor(Optional)</label>";
				echo "<input type = 'text' id = 'apartmentUnit' name = 'apartmentUnit' placeholder = 'Apartment, Unit, Suite, or Floor(Optional)' value= '".$row['apartmentUnit']."'><br>"; 
				
				echo "<label for = 'locality'>City</label>";
				echo "<input type = 'text' id = 'locality' name = 'locality' placeholder='City' value= '".$row['locality']."';><br>";
				
				echo "<label for = 'administrative_area_level_1'>State</label>";
				echo "<input type = 'text' id = 'administrative_area_level_1' name = 'administrative_area_level_1' placeholder='State' value= '".$row['administrative_area_level_1']."'><br>";
				
				echo "<label for = 'postal_code'>ZIP Code / Postal Code</label>";
				echo "<input type = 'text' id = 'postal_code' name = 'postal_code' placeholder='ZIP Code / Postal Code' value= '".$row['postal_code']."'><br>";
				
				echo "<label for = 'country'>Country</label>";
				echo "<input type = 'text' id = 'country' name = 'country' placeholder='Country' value= '".$row['country']."'>";
				
				echo "<br /><br /><input type='submit' name='submit' value='Submit' onClick=\"javascript: return confirm('Are you sure you want to update?');\">";
			echo "</form>";
		?>
		</div>
	
	</body>
	
	<script>  
		var placeSearch, autocomplete;
		var componentForm = {
		  locality: 'long_name',
		  administrative_area_level_1: 'short_name',
		  country: 'long_name',
		  postal_code: 'short_name'
		};

		function initAutocomplete() 
		{
		  // Create the autocomplete object, restricting the search to geographical location types.
		  /** @type {!HTMLInputElement} */
		  autocomplete = new google.maps.places.Autocomplete(
			(document.getElementById('autocomplete')), {
			  componentRestrictions: {country: 'my'},
			  types: ['geocode']
			});

		  // When the user selects an address from the dropdown, populate the address
		  // fields in the form.
		  autocomplete.addListener('place_changed', fillInAddress);
		}

		function fillInAddress() 
		{
		  // Get the place details from the autocomplete object.
		  var place = autocomplete.getPlace();

		  for (var component in componentForm) 
		  {
			document.getElementById(component).value = '';
			//document.getElementById(component).disabled = false;
		  }

		  // Get each component of the address from the place details
		  // and fill the corresponding field on the form.
		  for (var i = 0; i < place.address_components.length; i++) 
		  {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) 
			{
			  var val = place.address_components[i][componentForm[addressType]];
			  document.getElementById(addressType).value = val;
			}
		  }
		}

		// Bias the autocomplete object to the user's geographical location,
		// as supplied by the browser's 'navigator.geolocation' object.
		function geolocate() 
		{
		  if (navigator.geolocation) 
		  {
			navigator.geolocation.getCurrentPosition(function(position) {
			  var geolocation = 
			  {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			  };
			  var circle = new google.maps.Circle({
				center: geolocation,
				radius: position.coords.accuracy
			  });
			  autocomplete.setBounds(circle.getBounds());
			});
		  }
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&libraries=places&&callback=initAutocomplete" async defer></script>
	
</html>