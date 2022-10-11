<!DOCTYPE html>
<html>
	<head>
		<title>User Delivery Details Page</title>
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
				background-color:#F4F7F9;
			}
			
			.container
			{
				display:flex;
				height:970px;
				width:1350px;
				margin:auto;
				margin-top: 75px;
				margin-bottom:50px;
				border-style: solid;
				border-color: #E9ECEF;
			}
			
			.container1
			{
				height:415px;
				width:1350px;
				margin:auto;
				margin-top: 20px;
				margin-bottom:40px;
				border-style: solid;
				border-color: #E9ECEF;
			}
			
			.container2
			{
				height:470px;
				width:1350px;
				margin:auto;
				margin-top: 50px;
				margin-bottom:50px;
				border-style: solid;
				border-color: #E9ECEF;
				background-color:white;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				width: 50%;
				background-color:white;
				padding-left:50px;
				padding-top:30px;
			}
			
			.form1
			{
				display:flex;
				flex-direction:column;
				background-color:white;
				padding-left:50px;
				padding-top:30px;
			}
			
			.form2
			{
				background-color:white;
				padding-left:50px;
				padding-bottom:33px;
			}
			
			.sdH3
			{
				margin-top:30px;
				margin-left:50px;
			}
			
			.calculateWeight
			{
				width:25%;
				display:inline-block;
			    text-transform:uppercase;
				background-color:white;
				border: 2px solid #E9ECEF;
				color:black;
				padding: 12px 0px;
				font-size: 12px;
				border-radius:8px;
				margin-left:50px;
			}
			
			.calculateWeight:hover
			{
				background-color:#E9ECEF;
				color:black;
			}
			
			.calculateModal
			{
				  display: none; /* Hidden by default */
				  position: fixed; /* Stay in place */
				  z-index: 1; /* Sit on top */
				  padding-top: 100px; /* Location of the box */
				  left: 0;
				  top: 0;
				  width: 100%; /* Full width */
				  height: 100%; /* Full height */
				  overflow: auto; /* Enable scroll if needed */
				  background-color: rgb(0,0,0); /* Fallback color */
				  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}
			
			.calculateModalContent
			{
				background-color: #fefefe;
			    margin: auto;
			    padding: 20px;
			    border: 1px solid #888;
			    width: 80%;
			}
			
			/* The Close Button */
			.close 
			{
			  color: #aaaaaa;
			  float: right;
			  font-size: 28px;
			  font-weight: bold;
			}

			.close:hover,
			.close:focus 
			{
			  color: #000;
			  text-decoration: none;
			  cursor: pointer;
			}
			
			.nextButton
			{
				margin-right:60px;
				margin-bottom: 140px;
			}
			
			input[type=button]
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
				margin-bottom:20px;
			}
			
			input[type=button]:hover
			{
				background-color:#5499C7;
			}
			
			.receiver_details
			{
				display:flex;
				flex-direction:column;
				width: 50%;
				background-color:white;
				padding-right:30px;
				padding-top:30px;
			}
			
			input[type=checkbox]
			{
				margin-left:70px;
			}
			
			input[type=text],input[type=tel],input[type=date]
			{
				width:95%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:70%;
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
		
		//select all user data from database
		$sql="SELECT * FROM user WHERE userID = '$userID'";
		$result=mysqli_query($combine,$sql);
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		//Receive Data
		$fullName = $row['fullName'];
		$email = $row['email'];
		$contactNumber = $row['contactNumber'];
		$autocomplete = $row['autocomplete'];
		$apartmentUnit = $row['apartmentUnit'];
		$locality = $row['locality'];
		$administrative_area_level_1 = $row['administrative_area_level_1'];	
		$postal_code =  $row['postal_code'];
		$country = $row['country'];
	?>
	
	<body>
	
		<div class = "container">
			
			<form method = "POST" action = "user_delivery_details.php" class = "form" id = "senderAddress">
			
				<h3 style = "color:#21618C">Sender Details</h3><br/>
				
				<label for = "fullName">Full Name</label>
				<input type = "text" id = "fullName" name = "fullName" placeholder = "Full Name" value= "<?php echo $row["fullName"]; ?>"/><br/>
				
				<label for = "email">Email</label>
				<input type = "text" id = "email" name = "email" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php echo $row["email"]; ?>"/><br/>
				
				<label for = "contactNumber">Contact Number</label>
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php echo $row["contactNumber"]; ?>"/><br/>
				
				<label for = "autocomplete">Address</label>
				<input type = "text" id = "autocomplete" name = "autocomplete" onFocus = "geolocate()" placeholder = "Please Enter Address Here..." value= "<?php echo $row["autocomplete"]; ?>"/><br/>
				
				<label for = "apartmentUnit">Apartment, Unit, Suite, or Floor(Optional)</label>
				<input type = "text" id = "apartmentUnit" name = "apartmentUnit" placeholder = "Apartment, Unit, Suite, or Floor(Optional)" value= "<?php echo $row["apartmentUnit"]; ?>"><br/>	 
				
				<label for = "locality">City</label>
				<input type = "text" id = "locality" name = "locality" placeholder="City" value= "<?php echo $row["locality"]; ?>"><br/>
				
				<label for = "administrative_area_level_1">State</label>
				<input type = "text" id = "administrative_area_level_1" name = "administrative_area_level_1" placeholder="State" value= "<?php echo $row["administrative_area_level_1"]; ?>"><br/>
				
				<label for = "postal_code">ZIP Code / Postal Code</label>
				<input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code / Postal Code" value= "<?php echo $row["postal_code"]; ?>"><br/>
				
				<label for = "country">Country</label>
				<input type = "text" id = "country" name = "country" placeholder="Country" value= "<?php echo $row["country"]; ?>"><br/>
				
			</form>
			
			<div class = "receiver_details">
			
				<form method = "POST" action = "user_delivery_details.php" id = "receiverAddress">
				
					<h3 style = "color:#21618C">Receiver Details</h3><br/>
					
					<label for = "receiverFullName">Full Name</label>
					<input type = "text" id = "receiverFullName" name = "receiverFullName" placeholder = "Full Name" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/><br/><br/>
					
					<label for = "receiverEmail">Email</label>
					<input type = "text" id = "receiverEmail" name = "receiverEmail" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"/><br/><br/>
					
					<label for = "receiverContactNumber">Contact Number</label>
					<input type = "tel" id = "receiverContactNumber" name = "receiverContactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/><br/><br/>
					
					<label for = "receiverAddress">Address</label>
					<input type = "text" id = "receiverAddress" name = "receiverAddress" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["autocomplete"])) echo $_POST["autocomplete"]; ?>"/><br/><br/>
					
					<label for = "receiverApartmentUnit">Apartment, Unit, Suite, or Floor(Optional)</label>
					<input type = "text" id = "receiverApartmentUnit" name = "receiverApartmentUnit" placeholder = "Apartment, Unit, Suite, or Floor(Optional)" value= "<?php if(isset($_POST["apartmentUnit"])) echo $_POST["apartmentUnit"]; ?>"/><br/><br/>	 
					
					<label for = "receiverCity">City</label><br/>
					<input type = "text" id = "receiverCity" name = "receiverCity" placeholder="City" value= "<?php if(isset($_POST["receiverCity"])) echo $_POST["receiverCity"]; ?>"><br/><br/>
					
					<label for = "receiverState">State</label>
					<input type = "text" id = "receiverState" name = "receiverState" placeholder="State" value= "<?php if(isset($_POST["administrative_area_level_1"])) echo $_POST["administrative_area_level_1"]; ?>"><br/><br/>
					
					<label for = "receiverPostalCode">ZIP Code / Postal Code</label>
					<input type = "text" id = "receiverPostalCode" name = "receiverPostalCode" placeholder="ZIP Code / Postal Code" value= "<?php if(isset($_POST["postal_code"])) echo $_POST["postal_code"]; ?>"><br/><br/>
					
					<label for = "receiverCountry">Country</label>
					<input type = "text" id = "receiverCountry" name = "country" placeholder="Country" value= "<?php if(isset($_POST["country"])) echo $_POST["country"]; ?>"><br/><br/>
			  
				</form>
				
			</div>
		
		</div>
		
		<input type = "checkbox" id = "addReceiverDetails" name = "addReceiverDetails" value = "Additional Receiver Details" onclick = "enableFields()">
		<label for = "addReceiverDetails">Do you want to add additional receiver details?</label>
		
		<div class = "container1">
		
			<form method = "POST" action = "user_delivery_details.php" class = "form1" id = "additional">
			
				<h3 style = "color:#21618C">Additional Receiver Details</h3><br/>
				
				<label for = "addReceiverFullName">Full Name</label>
				<input type = "text" id = "addReceiverFullName" name = "addReceiverFullName" placeholder = "Full Name" disabled="true" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/><br/><br/>
				
				<label for = "addReceiverEmail">Email</label>
				<input type = "text" id = "addReceiverEmail" name = "addReceiverEmail" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" disabled="true" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"/><br/><br/>
				
				<label for = "addReceiverContactNumber">Contact Number</label>
				<input type = "tel" id = "addReceiverContactNumber" name = "addReceiverContactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" disabled="true" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/><br/><br/>
				
			</form>
			
		</div>
		
		<div class = "container2">
			
			<h3 style = "color:#21618C" class = "sdH3">Shipment Details</h3><br/>
			
			<button id = "calculateWeight" name = "calculateWeight" class = "calculateWeight">Parcel Volumetric Weight Calculator</button><br><br>
			
			<form method = "POST" action = "shipmentDetails.php" class = "form2" id = "shipmentDetails">
				
				<label for = "quantity">Parcel Weight(kg)</label><br/>
				<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg"><br><br>
				
				<label for = "mode">Parcel Collection Date</label><br>
				<input type = "date" id = "collectionDate" name = "collectionDate"><br><br>
				
				<label for = "mode">Parcel Content</label><br>
				<input type = "text" id = "parcelContent" name = "parcelContent" placeholder = "Eg:Book"><br><br>
				
				<label for = "mode">Parcel Value(MYR)</label><br>
				<input type = "text" id = "parcelContent" name = "parcelContent" placeholder = "Eg:15.00"><br><br>
			
			</form>
		
		</div>
		
		<div class = "calculateModal" id = "calculateModal" name = "calculateModal">
		
			<div class = "calculateModalContent">
				<span class="close">&times;</span>
				<form method = "POST" action = "shipmentDetails.php" id = "calculateModal">
					<label for = "quantity">Parcel Length(cm)</label><br/>
					<input type="text" id="parcelLength" name="parcelLength" placeholder = "Eg:80"><br><br>
					
					<label for = "quantity">Parcel Width(cm)</label><br/>
					<input type="text" id="parcelWidth" name="parcelWidth" placeholder = "Eg:100"><br><br>
					
					<label for = "quantity">Parcel Height(cm)</label><br/>
					<input type="text" id="parcelHeight" name="parcelHeight" placeholder = "Eg:30"><br><br>
					
					<input type = "hidden" name = "submitted" value = "true"/>
					<input type = "submit" style = "float:center" value = "SUBMIT" name = "submit"/> 
					
					<p>Total Parcel Weight: </p>
				</form>
			
			</div>
		
		</div>
		
		<div class = "nextButton">
			<a href = "shipmentDetails.php"><input type="button" value="NEXT" style="float: right;"></a>	
		</div>
	
	</body>  
	
	<script>
	
		//Get the Calculator Modal
		var calculateModal = document.getElementById("calculateModal");
		var calculateWeight = document.getElementById("calculateWeight");
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		
		calculateWeight.onclick = function() 
		{
		  calculateModal.style.display = "block";
		}
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  calculateModal.style.display = "none";
		}
	</script>
	
	<script>
		function enableFields()
		{
			var addReceiverDetails = document.getElementById("addReceiverDetails");
			var addReceiverFullName = document.getElementById("addReceiverFullName");
			var addReceiverEmail = document.getElementById("addReceiverEmail");
			var addReceiverContactNumber = document.getElementById("addReceiverContactNumber");
			
			if(addReceiverDetails.checked == true)
			{
				addReceiverFullName.disabled = false;
				addReceiverEmail.disabled = false;
				addReceiverContactNumber.disabled = false;
			}
			else
			{
				addReceiverFullName.disabled = true;
				addReceiverEmail.disabled = true;
				addReceiverContactNumber.disabled = true;
			}
			
		}
	</script>
		
	<!--Sender address autocomplete-->
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