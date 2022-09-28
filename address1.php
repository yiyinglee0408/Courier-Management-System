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
			 <input type = "text" id = "locality" name = "locality" placeholder="City">
			 <input type = "text" id = "administrative_area_level_1" name = "administrative_area_level_1" placeholder="State">
			 <input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code / Postal Code">
			 <input type = "text" id = "country" name = "country" placeholder="Country">
			 <button type = "button" id = "addressButton" name = "addressButton">Submit</button>
		</form>	
	</body>
	
	<script type="module">
	  // Import the functions you need from the SDKs you need
	  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
	  import { getDatabase, set, ref, update } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-database.js";
	  // TODO: Add SDKs for Firebase products that you want to use
	  // https://firebase.google.com/docs/web/setup#available-libraries

	  // Your web app's Firebase configuration
	  const firebaseConfig = {
		apiKey: "AIzaSyBgBlBb_-KCvANhu66fq7zzARGoPqxyYnk",
		authDomain: "address-3d36e.firebaseapp.com",
		databaseURL: "https://address-3d36e-default-rtdb.firebaseio.com",
		projectId: "address-3d36e",
		storageBucket: "address-3d36e.appspot.com",
		messagingSenderId: "276390177455",
		appId: "1:276390177455:web:00227a31c86c943cdbc25a"
	  };

	  // Initialize Firebase
	  const app = initializeApp(firebaseConfig);
	  const database = getDatabase(app);
	  
	  addressButton.addEventListener('click',(e)=> {
		  var autocomplete = document.getElementById('autocomplete').value;
		  var address2 = document.getElementById('address2').value;
		  var locality = document.getElementById('locality').value;
		  var administrative_area_level_1 = document.getElementById('administrative_area_level_1').value;
		  var postal_code = document.getElementById('postal_code').value;
		  var country = document.getElementById('country').value;
		  
		  set(ref(database, 'AutocompleteAddress/' + '/CompleteAddress'),{
			address : autocomplete,
			address2 : address2,		
			locality : locality,
			state : administrative_area_level_1,
			postal_code : postal_code,
			country : country
		 })
		 
		 alert('You have been enter successfully!');
	  });
	</script>
	
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmGUA_BLfucAv8MUM5xfpyg_N0bPhH6jw&libraries=places&&callback=initAutocomplete" async defer></script>
</html>