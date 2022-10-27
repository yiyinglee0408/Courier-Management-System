<!DOCTYPE html>
<html>
	<head>
		<title>Status of Item Accepted by Courier Page</title>
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
				margin-top:25px;
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
				margin-left:50px;
				padding-bottom:50px;
			}
			
			input[type=text]
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
		
		include('admin_sidebar.php');
		
		//if(isset($_POST['submitted']))
		//{
		//}
	?>
	
	<body>
		<h4>Courier Address</h4>
		<div class = "container">
			<h2 style = "margin-top:25px; margin-left:50px;"><font color = "#21618C">Courier Address</font></h2><br><br>
			<form method = "POST" action = "addCourierAddress.php" class = "form">
				<label for = "addressName">Address Name</label>
				<input type = "text" id = "addressName" name = "addressName" placeholder = "Address Name" value= "<?php if(isset($_POST["addressName"])) echo $_POST["addressName"]; ?>"/><br><br>
				
				<label for = "autocomplete">Address</label>
				<input type = "text" id = "autocomplete" name = "autocomplete" onFocus = "geolocate()" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["autocomplete"])) echo $_POST["autocomplete"]; ?>"/><br><br>
				
				<label for = "lat">Latitude</label>
				<input type = "text" id = "lat" name = "lat" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["lat"])) echo $_POST["lat"]; ?>"/><br><br>
				
				<label for = "lon">Longitude</label>
				<input type = "text" id = "lng" name = "lng" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["lon"])) echo $_POST["lon"]; ?>"/><br><br>
				
				<label for = "locality">City</label>
				<input type = "text" id = "locality" name = "locality" placeholder="City" value= "<?php if(isset($_POST["locality"])) echo $_POST["locality"]; ?>"><br><br>
				
				<label for = "administrative_area_level_1">State</label>
				<input type = "text" id = "administrative_area_level_1" name = "administrative_area_level_1" placeholder="State" value= "<?php if(isset($_POST["administrative_area_level_1"])) echo $_POST["administrative_area_level_1"]; ?>"><br><br>
				
				<label for = "postal_code">ZIP Code / Postal Code</label>
				<input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code / Postal Code" value= "<?php if(isset($_POST["postal_code"])) echo $_POST["postal_code"]; ?>"><br><br>
				
				<label for = "country">Country</label>
				<input type = "text" id = "country" name = "country" placeholder="Country" value= "<?php if(isset($_POST["country"])) echo $_POST["country"]; ?>"><br><br>
			
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" value = "SUBMIT" name = "submit"/> 
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