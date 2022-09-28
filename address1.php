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
			 <input type = "text" id = "address2" name = "address2" placeholder = "Apartment, unit, suite, or floor(Optional)">		 
			 <!--<input class="form-control" id="route" disabled="true" placeholder="Route">-->
			 <input type = "text" id = "city" name = "city" placeholder="City">
			 <input type = "text" id = "state" name = "state" placeholder="State">
			 <input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code">
			 <input type = "text" id = "country" name = "country" placeholder="Country">
		</form>	
	</body>
	
	<script>  
	  var placeSearch, autocomplete;
		var componentForm = {
		  city: 'long_name',
		  state: 'short_name',
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjVrS6uoHAuYvY_T-s3IAfRkaKTdP0hsY&libraries=places&&callback=initAutocomplete" async defer></script>
</html>