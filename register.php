<!DOCTYPE html>
<html>
	<head>
		<title>Register Page</title>
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
				padding-left:45px;
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
			
			label
			{
				text-align: left;
			}
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		//User Register Details
		if(isset($_POST['submit']))
		{
			$fullName =  $_POST['fullName'];
			$email    =  $_POST['email'];
			$contactNumber = $_POST['contactNumber'];
			$autocomplete = $_POST['autocomplete'];
			$apartmentUnit = $_POST['apartmentUnit'];
			$locality = $_POST['locality'];
			$administrative_area_level_1 = $_POST['administrative_area_level_1'];	
			$postal_code =  $_POST['postal_code'];
			$country = $_POST['country'];
			$password =  $_POST['password'];
			$confirmPassword =  $_POST['confirmPassword'];
			
			//$uppercase    = preg_match('@[A-Z]@', $password);
			//$lowercase    = preg_match('@[a-z]@', $password);
			//$number       = preg_match('@[0-9]@', $password);
			//$specialChars = preg_match('@[^\w]@', $password);
			
			$fullName = mysqli_real_escape_string($combine, $fullName);
			$email = mysqli_real_escape_string($combine, $email);
			$password = mysqli_real_escape_string($combine, $password);
			$password = $password;
			
			//Register Form Validation
			if(empty($fullName) || empty($email) || empty($contactNumber) || empty($autocomplete) || empty($locality) || empty($administrative_area_level_1) || empty($postal_code) || empty($country) || empty($password) || empty($confirmPassword))
			{
				echo"<script>alert('Please do not let the field empty!')</script>";
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				echo"<script>alert('Please enter a valid email!')</script>";
			}
			elseif (strlen($password) <='8' || strlen($password) >'16' || !preg_match("#[0-9]+#",$password) || !preg_match("#[A-Z]+#",$password) || !preg_match("#[a-z]+#",$password) || !preg_match("#[^\w]+#",$password)) 
			{
				echo "<script>alert('Password should contain one uppercase letter,one lowercase letter,one number,one special character and length could not less than 8 or lonnger than 16 character')</script>";
			}
			elseif($_POST['password'] != $_POST['confirmPassword'])
			{
				echo"<script>alert('Password and Confirm Password are not match!')</script>";
			}
			else
			{
				//Check from database to make sure a user does not exist with the same username
				$sql="SELECT email FROM user WHERE email='$email'";
				$result=mysqli_query($combine,$sql);
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				if(mysqli_num_rows($result)== 1)
				{
					//message when data had record in database
					echo "<script>alert('Sorry... This username had already used. Please try another.');
						window.location='register.php'</script>";
				}
					//store new record
				else if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
				{
					//success store data and display message
					$query = mysqli_query($combine, "INSERT INTO user
					(username, email, contactNumber, password, autocomplete, apartmentUnit, locality, administrative_area_level_1, postal_code, country) VALUES
					('$username', '$email', '$contactNumber', '$password', '$autocomplete', '$apartmentUnit', '$locality', '$administrative_area_level_1', '$postal_code', '$country')");
					if ($query)
					{
						$_SESSION['username'] = $username;
						//$_SESSION['success'] = "You are now logged in";
						echo "<script>alert('Your account had been success key in.');
						window.location='login.php'</script>";
					}
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
			
			<form method = "POST" action ="register.php" class = "form">
				<h1 style="text-transform:uppercase; text-align:center">Register</h1>
				
				<p style="margin-bottom:20px; text-align:center"><small>Already have an account? <a href = "login.php" style="color:#2874A6"><strong>Log In</strong></a></small></p>
				
				<label for = "fullName">Full Name</label>
				<input type = "text" id = "fullName" name = "fullName" placeholder = "Full Name" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/><br>
				
				<label for = "email">Email</label>
				<input type = "text" id = "email" name = "email" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"/><br>
				
				<label for = "contactNumber">Contact Number</label>
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/><br>
				
				<label for = "autocomplete">Address</label>
				<input type = "text" id = "autocomplete" name = "autocomplete" onFocus = "geolocate()" placeholder = "Please Enter Address Here..." value= "<?php if(isset($_POST["autocomplete"])) echo $_POST["autocomplete"]; ?>"/><br>
				
				<label for = "apartmentUnit">Apartment, Unit, Suite, or Floor(Optional)</label>
				<input type = "text" id = "apartmentUnit" name = "apartmentUnit" placeholder = "Apartment, Unit, Suite, or Floor(Optional)" value= "<?php if(isset($_POST["apartmentUnit"])) echo $_POST["apartmentUnit"]; ?>"><br>	 
				
				<label for = "locality">City</label>
				<input type = "text" id = "locality" name = "locality" placeholder="City" value= "<?php if(isset($_POST["locality"])) echo $_POST["locality"]; ?>"><br>
				
				<label for = "administrative_area_level_1">State</label>
				<input type = "text" id = "administrative_area_level_1" name = "administrative_area_level_1" placeholder="State" value= "<?php if(isset($_POST["administrative_area_level_1"])) echo $_POST["administrative_area_level_1"]; ?>"><br>
				
				<label for = "postal_code">ZIP Code / Postal Code</label>
				<input type = "text" id = "postal_code" name = "postal_code" placeholder="ZIP Code / Postal Code" value= "<?php if(isset($_POST["postal_code"])) echo $_POST["postal_code"]; ?>"><br>
				
				<label for = "country">Country</label>
				<input type = "text" id = "country" name = "country" placeholder="Country" value= "<?php if(isset($_POST["country"])) echo $_POST["country"]; ?>"><br>
				
				<label for = "password">Password</label>
				<input type = "password" id = "password" name = "password" placeholder = "Password"  value= "<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>"/><br>
				
				<label for = "confirmPassword">Confirm Password</label>
				<input type = "password" id = "confirmPassword" name = "confirmPassword" placeholder = "Confirm Password">
				
				<input type = "submit" style = "float:center" value = "REGISTER" name = "submit"/> 	
				
				<p><small><center>By continuing, you agree to our<br><a href = "#" style="color:#2874A6">Terms and Conditions</a> and <a href = "#" style="color:#2874A6">Privacy Policy</a></center></small></p>
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