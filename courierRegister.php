<!DOCTYPE html>
<html>
	<head>
		<title>Courier Register Page</title>
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
				background:url("image/registerBackground.jpeg");
				background-repeat: no-repeat;
				background-size: 200%;
			}
			
			a
			{
				text-decoration: none;
			}
			
			a:hover
			{
				text-decoration: underline;
			}
			
			.container
			{
				display:flex;
				height:1270px;
				width: 1100px;
				margin:auto;
				margin-top: 75px;
				margin-bottom:75px;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				width: 50%;
				padding-left:50px;
				background-color:white;
			}
			
			.form h1
			{
				margin:20px;
			}
			
			input[type=text], input[type=password], input[type=email], input[type=tel]
			{
				width:88%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:88%;
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
			
			.image
			{
				display:flex;
				justify-content:center;
				align-items:center;
			}
			
			.image img
			{
				width:550px;
				height:1270px;
			}
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		//User Register Details
		if(isset($_POST['submitted']))
		{
			$courierName =  $_POST['courierName'];
			$courierEmail    =  $_POST['courierEmail'];
			$courierContactNumber = $_POST['courierContactNumber'];
			$autocomplete = $_POST['autocomplete'];
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			$locality = $_POST['locality'];
			$administrative_area_level_1 = $_POST['administrative_area_level_1'];	
			$postal_code =  $_POST['postal_code'];
			$country = $_POST['country'];
			$courierPassword =  $_POST['courierPassword'];
			$courierConfirmPassword =  $_POST['courierConfirmPassword'];
			
			$courierName = mysqli_real_escape_string($combine, $courierName);
			$courierEmail = mysqli_real_escape_string($combine, $courierEmail);
			$courierPassword = mysqli_real_escape_string($combine, $courierPassword);
			$courierPassword = $courierPassword;
			
			//Register Form Validation
			if(empty($courierName) || empty($courierEmail) || empty($courierContactNumber) || empty($autocomplete) || empty($lat) || empty($lng) || empty($locality) || empty($administrative_area_level_1) || empty($postal_code) || empty($country) || empty($courierPassword) || empty($courierConfirmPassword))
			{
				echo"<script>alert('Please do not let the field empty!')</script>";
			}
			elseif (!filter_var($courierEmail, FILTER_VALIDATE_EMAIL))
			{
				echo"<script>alert('Please enter a valid email!')</script>";
			}
			elseif (strlen($courierPassword) <='8' || strlen($courierPassword) >'16' || !preg_match("#[0-9]+#",$courierPassword) || !preg_match("#[A-Z]+#",$courierPassword) || !preg_match("#[a-z]+#",$courierPassword) || !preg_match("#[^\w]+#",$courierPassword)) 
			{
				echo "<script>alert('Password should contain one uppercase letter,one lowercase letter,one number,one special character and length could not less than 8 or lonnger than 16 character')</script>";
			}
			elseif($_POST['courierPassword'] != $_POST['courierConfirmPassword'])
			{
				echo"<script>alert('Password and Confirm Password are not match!')</script>";
			}
			else
			{
				//success store data and display message
				$query = mysqli_query($combine, "INSERT INTO courier
				(courierName, courierEmail, courierContactNumber,autocomplete, lat, lng, locality, administrative_area_level_1, postal_code, country, courierPassword) VALUES
				('$courierName', '$courierEmail', '$courierContactNumber', '$autocomplete', '$lat', '$lng', '$locality', '$administrative_area_level_1', '$postal_code', '$country', '$courierPassword')");
				if ($query)
				{
					$_SESSION['courierName'] = $courierName;
					//$_SESSION['success'] = "You are now logged in";
					echo "<script>alert('Your account had been success key in.');
					window.location='login.php'</script>";
				}
				else
				{
					//message invalid input
					echo"<script>alert('You have no success store record in database')</script>";
				}
			}
		}
	?>
	
	<body>
		<div class = "container">
			
			<div class = "image">
				<img src = "image/register.jpg" alt = "User Register">
			</div>
			
			<form method = "POST" action ="courierRegister.php" class = "form">
				<h1 style="text-transform:uppercase; text-align:center">Courier Register</h1>
				
				<p style="margin-bottom:20px; text-align:center"><small>Already have an account? <a href = "login.php" style="color:#2874A6"><strong>Log In</strong></a></small></p>
				
				<label for = "courierName">Company Name</label>
				<input type = "text" id = "courierName" name = "courierName" placeholder = "Courier Company Name" value= "<?php if(isset($_POST["courierName"])) echo $_POST["courierName"]; ?>"/><br>
				
				<label for = "courierEmail">Email</label>
				<input type = "text" id = "courierEmail" name = "courierEmail" placeholder = "Email" value= "<?php if(isset($_POST["courierEmail"])) echo $_POST["courierEmail"]; ?>"/><br>
				
				<label for = "courierContactNumber">Contact Number</label>
				<input type = "tel" id = "courierContactNumber" name = "courierContactNumber" placeholder = "Contact Number" pattern = "[0-9]{2,3}-[0-9]{7,8}" value= "<?php if(isset($_POST["courierContactNumber"])) echo $_POST["courierContactNumber"]; ?>"/><br>
				
				<label for = "autocomplete">Address</label>
				<input type = "text" id = "autocomplete" name = "autocomplete" onFocus = "geolocate()" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["autocomplete"])) echo $_POST["autocomplete"]; ?>"/><br>
				
				<label for = "lat">Latitude</label>
				<input type = "text" id = "lat" name = "lat" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["lat"])) echo $_POST["lat"]; ?>"/><br>
				
				<label for = "lng">Longitude</label>
				<input type = "text" id = "lng" name = "lng" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["lon"])) echo $_POST["lon"]; ?>"/><br>
				
				<label for = "locality">City</label>
				<input type = "text" id = "locality" name = "locality" placeholder="City" value= "<?php if(isset($_POST["locality"])) echo $_POST["locality"]; ?>"><br>
				
				<label for = "administrative_area_level_1">State</label>
				<input type = "text" id = "administrative_area_level_1" name = "administrative_area_level_1" placeholder="State" value= "<?php if(isset($_POST["administrative_area_level_1"])) echo $_POST["administrative_area_level_1"]; ?>"><br>
				
				<label for = "postal_code">ZIP Code / Postal Code</label>
				<input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code / Postal Code" value= "<?php if(isset($_POST["postal_code"])) echo $_POST["postal_code"]; ?>"><br>
				
				<label for = "country">Country</label>
				<input type = "text" id = "country" name = "country" placeholder="Country" value= "<?php if(isset($_POST["country"])) echo $_POST["country"]; ?>"><br>
				
				<label for = "courierPassword">Password</label>
				<input type = "password" id = "courierPassword" name = "courierPassword" placeholder = "Password"  value= "<?php if(isset($_POST["courierPassword"])) echo $_POST["courierPassword"]; ?>"/><br>
				
				<label for = "courierConfirmPassword">Confirm Password</label>
				<input type = "password" id = "courierConfirmPassword" name = "courierConfirmPassword" placeholder = "Confirm Password">
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:center" value = "REGISTER" name = "submit"/> 	
			</form>
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
		  document.getElementById('lat').value = place.geometry.location.lat();
		  document.getElementById('lng').value = place.geometry.location.lng();

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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmGUA_BLfucAv8MUM5xfpyg_N0bPhH6jw&libraries=places&&callback=initAutocomplete" async defer></script>
</html>
	