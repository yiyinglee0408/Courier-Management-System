<!DOCTYPE html>
<html>
	<head>
		<title>Autocomplete Address Page</title>
		<meta charset = "utf-8">
	</head>
	
	<body>
		<form method = "POST" action = "address1.php">
			 <input type = "text" id = "autocomplete" name = "autocomplete" placeholder = "Please enter your address..." onFocus = "geolocate()">
			 <input type = "text" id = "streetNumber" name = "streetNumber" placeholder="Street address">
			 <input type = "text" id = "route" name = "route" placeholder="Route">
			 <input type = "text" id = "city" name = "city" placeholder="City">
			 <input type = "text" id = "state" name = "state" placeholder = "State">
			 <input type = "text" id = "postalCode" name = "postalCode" placeholder = "ZIP Code">
			 <input type = "text" id = "country" name = "country" placeholder="Country">
		</form>
	</body>
	
	<script>
		var placeSearch, autocomplete;
		var componentForm = {
		  streetNumber: 'short_name',
		  route: 'long_name',
		  city: 'long_name',
		  state: 'short_name',
		  country: 'long_name',
		  postalCode: 'short_name'
		};

		function initAutocomplete() 
		{
		  // Create the autocomplete object, restricting the search to geographical
		  // location types.
		  autocomplete = new google.maps.places.Autocomplete(
			/** @type {!HTMLInputElement} */
			(document.getElementById('autocomplete')), {
			  componentRestrictions: {
				country: 'my'
			  },
			  types: ['geocode']
			});

		  // When the user selects an address from the dropdown, populate the address
		  // fields in the form.
		  autocomplete.addListener('place_changed', fillInAddress);
		}

		function fillInAddress() {
		  // Get the place details from the autocomplete object.
		  var place = autocomplete.getPlace();

		  for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		  }

		  // Get each component of the address from the place details
		  // and fill the corresponding field on the form.
		  for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
			  var val = place.address_components[i][componentForm[addressType]];
			  document.getElementById(addressType).value = val;
			}
		  }
		}

		// Bias the autocomplete object to the user's geographical location,
		// as supplied by the browser's 'navigator.geolocation' object.
		function geolocate() {
		  if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
			  var geolocation = {
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