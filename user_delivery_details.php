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
				height:2953px;
				width:1050px;
				margin:auto;
				margin-top:25px;
				margin-bottom:5px;
				margin-left:340px;
				border-style: solid;
				border-color: #E9ECEF;
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
			
			.receiver_details
			{
				background-color:white;
				padding-right:30px;
				padding-top:30px;
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
		
		if(isset($_POST['submitted']))
		{
			$receiverFullName =  $_POST['receiverFullName'];
			$receiverEmail    =  $_POST['receiverEmail'];
			$receiverContactNumber = $_POST['receiverContactNumber'];
			$receiverAddress = $_POST['receiverAddress'];
			$receiverApartmentUnit = $_POST['receiverApartmentUnit'];
			$receiverCity = $_POST['receiverCity'];
			$receiverState = $_POST['receiverState'];	
			$receiverPostalCode =  $_POST['receiverPostalCode'];
			$receiverCountry = $_POST['receiverCountry'];
			$addReceiverFullName =  $_POST['addReceiverFullName'];
			$addReceiverEmail =  $_POST['addReceiverEmail'];
			$addReceiverContactNumber = $_POST['addReceiverContactNumber'];
			$parcelWeight = $_POST['parcelWeight'];
			$collectionDate = $_POST['collectionDate'];
			$parcelContent = $_POST['parcelContent'];
			$parcelValue = $_POST['parcelValue'];
			
			$receiverFullName = mysqli_real_escape_string($combine, $receiverFullName);
			$receiverEmail = mysqli_real_escape_string($combine, $receiverEmail);
			$receiverContactNumber = mysqli_real_escape_string($combine, $receiverContactNumber);
			$receiverAddress = mysqli_real_escape_string($combine, $receiverAddress);
			$receiverApartmentUnit = mysqli_real_escape_string($combine, $receiverApartmentUnit);
			$receiverCity = mysqli_real_escape_string($combine, $receiverCity);
			$receiverState = mysqli_real_escape_string($combine, $receiverState);
			$receiverPostalCode = mysqli_real_escape_string($combine, $receiverPostalCode);
			$receiverCountry = mysqli_real_escape_string($combine, $receiverCountry);
			$addReceiverFullName = mysqli_real_escape_string($combine, $addReceiverFullName);
			$addReceiverEmail = mysqli_real_escape_string($combine, $addReceiverEmail);
			$addReceiverContactNumber = mysqli_real_escape_string($combine, $addReceiverContactNumber);
			//$parcelLength = mysqli_real_escape_string($combine, $parcelLength);
			//$parcelWidth = mysqli_real_escape_string($combine, $parcelWidth);
			//$parcelHeight = mysqli_real_escape_string($combine, $parcelHeight);
			//$parcelWeight = mysqli_real_escape_string($combine, $parcelWeight);
			$collectionDate = mysqli_real_escape_string($combine, $collectionDate);
			$parcelContent = mysqli_real_escape_string($combine, $parcelContent);
			$parcelValue = mysqli_real_escape_string($combine, $parcelValue);
			
			$trackingNumber = rand(1000000000,9999999999);			
			
			if(empty($receiverFullName) || empty($receiverEmail) || empty($receiverContactNumber) || empty($receiverAddress) || empty($receiverApartmentUnit) || empty($receiverCity) || empty($receiverState) || empty($receiverPostalCode) || empty($receiverCountry) || empty($collectionDate) || empty($parcelContent) || empty($parcelValue))
			{
				echo"<script>alert('Please do not let the field empty!')</script>";
			}
			elseif (!filter_var($receiverEmail, FILTER_VALIDATE_EMAIL))
			{
				echo"<script>alert('Please enter a valid email!')</script>";
			}
			elseif (!filter_var($receiverEmail, FILTER_VALIDATE_EMAIL))
			{
				echo"<script>alert('Please enter a valid email!')</script>";
			}
			else
			{
				//Check from database to make sure a user does not exist with the same email
				//success store data and display message
				$query = mysqli_query($combine, "INSERT INTO user_delivery_details
				(userID, fullName, trackingNumber, email, contactNumber, autocomplete, apartmentUnit, locality, administrative_area_level_1, postal_code, country, receiverFullName, receiverEmail, receiverContactNumber, receiverAddress, receiverApartmentUnit, receiverCity, receiverState, receiverPostalCode, receiverCountry, addReceiverFullName, addReceiverEmail, addReceiverContactNumber, parcelWeight, collectionDate, parcelContent, parcelValue) VALUES
				('$userID','$fullName', '$trackingNumber', '$email', '$contactNumber', '$autocomplete', '$apartmentUnit', '$locality', '$administrative_area_level_1', '$postal_code', '$country', '$receiverFullName', '$receiverEmail', '$receiverContactNumber', '$receiverAddress', '$receiverApartmentUnit', '$receiverCity', '$receiverState', '$receiverPostalCode', '$receiverCountry', '$addReceiverFullName', '$addReceiverEmail', '$addReceiverContactNumber', '$parcelWeight', '$collectionDate', '$parcelContent', '$parcelValue')");
				if ($query)
				{
					//$_SESSION['success'] = "You are now logged in";
					echo "<script>alert('Your delivery details had been success key in and your parcel tracking number is $trackingNumber.');
					window.location='tracking_number.php'</script>";
				}
				else
				{
					//message invalid input
					echo"<script>alert('You have no success store record in database')</script>";
				}
			}
			
		}
	?>
	
	<?php
		include('user_sidebar.php');
	?>
	
	<body>
		<h1>New Parcel</h1>
		
		<div class = "container">
			
			<form method = "POST" action = "user_delivery_details.php" class = "form">
			
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
				<input type = "text" id = "country" name = "country" placeholder="Country" value= "<?php echo $row["country"]; ?>"><br/><br>
				
				<h3 style = "color:#21618C">Receiver Details</h3><br/>
				
				<label for = "receiverFullName">Full Name</label>
				<input type = "text" id = "receiverFullName" name = "receiverFullName" placeholder = "Full Name" value= "<?php if(isset($_POST["receiverFullName"])) echo $_POST["receiverFullName"]; ?>"/><br/>
				
				<label for = "receiverEmail">Email</label>
				<input type = "text" id = "receiverEmail" name = "receiverEmail" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["receiverEmail"])) echo $_POST["receiverEmail"]; ?>"/><br/>
				
				<label for = "receiverContactNumber">Contact Number</label>
				<input type = "tel" id = "receiverContactNumber" name = "receiverContactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["receiverContactNumber"])) echo $_POST["receiverContactNumber"]; ?>"/><br/>
				
				<label for = "receiverAddress">Address</label>
				<input type = "text" id = "receiverAddress" name = "receiverAddress" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["receiverAddress"])) echo $_POST["receiverAddress"]; ?>"/><br/>
				
				<label for = "receiverApartmentUnit">Apartment, Unit, Suite, or Floor(Optional)</label>
				<input type = "text" id = "receiverApartmentUnit" name = "receiverApartmentUnit" placeholder = "Apartment, Unit, Suite, or Floor(Optional)" value= "<?php if(isset($_POST["receiverApartmentUnit"])) echo $_POST["receiverApartmentUnit"]; ?>"/><br/>
				
				<label for = "receiverCity">City</label>
				<input type = "text" id = "receiverCity" name = "receiverCity" placeholder="City" value= "<?php if(isset($_POST["receiverCity"])) echo $_POST["receiverCity"]; ?>"><br/>
				
				<label for = "receiverState">State</label>
				<input type = "text" id = "receiverState" name = "receiverState" placeholder="State" value= "<?php if(isset($_POST["receiverState"])) echo $_POST["receiverState"]; ?>"><br/>
				
				<label for = "receiverPostalCode">ZIP Code / Postal Code</label>
				<input type = "text" id = "receiverPostalCode" name = "receiverPostalCode" placeholder="ZIP Code / Postal Code" value= "<?php if(isset($_POST["receiverPostalCode"])) echo $_POST["receiverPostalCode"]; ?>"><br/>
				
				<label for = "receiverCountry">Country</label>
				<input type = "text" id = "receiverCountry" name = "receiverCountry" placeholder="Country" value= "<?php if(isset($_POST["receiverCountry"])) echo $_POST["receiverCountry"]; ?>"><br/><br/>
				
				<h3 style = "color:#21618C">Additional Receiver Details (Optional)</h3><br/>
			
				<label for = "addReceiverFullName">Full Name</label>
				<input type = "text" id = "addReceiverFullName" name = "addReceiverFullName" placeholder = "Full Name" value= "<?php if(isset($_POST["addReceiverFullName"])) echo $_POST["addReceiverFullName"]; ?>"/><br/><br/>
				
				<label for = "addReceiverEmail">Email</label><br>
				<input type = "text" id = "addReceiverEmail" name = "addReceiverEmail" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["addReceiverEmail"])) echo $_POST["addReceiverEmail"]; ?>"/><br/><br/>
				
				<label for = "addReceiverContactNumber">Contact Number</label>
				<input type = "tel" id = "addReceiverContactNumber" name = "addReceiverContactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["addReceiverContactNumber"])) echo $_POST["addReceiverContactNumber"]; ?>"/><br/><br/>
				
				<h3 style = "color:#21618C">Shipment Details</h3><br/>
				
				<label for = "quantity">Parcel Weight(kg)</label><br/>
				<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg" value= "<?php if(isset($_POST["parcelWeight"])) echo $_POST["parcelWeight"]; ?>"><br><br>
				
				<label for = "collectionDate">Parcel Collection Date</label><br>
				<input type = "date" id = "collectionDate" name = "collectionDate"><br><br>
				
				<label for = "parcelContent">Parcel Content</label><br>
				<input type = "text" id = "parcelContent" name = "parcelContent" placeholder = "Eg:Book"><br><br>
				
				<label for = "parcelValue">Parcel Value(MYR)</label><br>
				<input type = "text" id = "parcelValue" name = "parcelValue" placeholder = "Eg:15.00"><br><br>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "SUBMIT" name = "submit"/> 
			
			</form>
		
		</div>
		
		
		
		<!--<input type = "checkbox" id = "addReceiverDetails" name = "addReceiverDetails" value = "Additional Receiver Details" onclick = "enableFields()">
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
			
			<form method = "POST" action = "shipmentDetails.php" class = "form2" id = "shipmentDetails">
			
				<label for = "quantity">Parcel Length(cm)</label><br/>
				<input type="text" id="parcelLength" name="parcelLength" placeholder = "Eg:80"><br><br>
				
				<label for = "quantity">Parcel Width(cm)</label><br/>
				<input type="text" id="parcelWidth" name="parcelWidth" placeholder = "Eg:100"><br><br>
				
				<label for = "quantity">Parcel Height(cm)</label><br/>
				<input type="text" id="parcelHeight" name="parcelHeight" placeholder = "Eg:30"><br><br>
				
				<label for = "quantity">Parcel Weight(kg)</label><br/>
				<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg"><br><br>
				
				<label for = "collectionDate">Parcel Collection Date</label><br>
				<input type = "date" id = "collectionDate" name = "collectionDate"><br><br>
				
				<label for = "parcelContent">Parcel Content</label><br>
				<input type = "text" id = "parcelContent" name = "parcelContent" placeholder = "Eg:Book"><br><br>
				
				<label for = "parcelValue">Parcel Value(MYR)</label><br>
				<input type = "text" id = "parcelValue" name = "parcelValue" placeholder = "Eg:15.00"><br><br>
	
			</form>
		
		</div>-->
	
	</body>  
		
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