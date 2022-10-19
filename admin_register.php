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
				height:700px;
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
				margin-top:50px;
				margin-bottom:50px;
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
				height:700px;
			}
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		//User Register Details
		if(isset($_POST['submit']))
		{
			$adminFullName =  $_POST['adminFullName'];
			$adminEmail    =  $_POST['adminEmail'];
			$adminContactNumber = $_POST['adminContactNumber'];
			$adminPassword =  $_POST['adminPassword'];
			$adminConfirmPassword =  $_POST['adminConfirmPassword'];
			
			//$uppercase    = preg_match('@[A-Z]@', $password);
			//$lowercase    = preg_match('@[a-z]@', $password);
			//$number       = preg_match('@[0-9]@', $password);
			//$specialChars = preg_match('@[^\w]@', $password);
			
			$adminFullName = mysqli_real_escape_string($combine, $adminFullName);
			$adminEmail = mysqli_real_escape_string($combine, $adminEmail);
			$adminPassword = mysqli_real_escape_string($combine, $adminPassword);
			$adminPassword = $adminPassword;
			
			//Register Form Validation
			if(empty($adminFullName) || empty($adminEmail) || empty($adminContactNumber) || empty($adminPassword) || empty($adminConfirmPassword))
			{
				echo"<script>alert('Please do not let the field empty!')</script>";
			}
			elseif (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL))
			{
				echo"<script>alert('Please enter a valid email!')</script>";
			}
			elseif (strlen($adminPassword) <='8' || strlen($adminPassword) >'16' || !preg_match("#[0-9]+#",$adminPassword) || !preg_match("#[A-Z]+#",$adminPassword) || !preg_match("#[a-z]+#",$adminPassword) || !preg_match("#[^\w]+#",$adminPassword)) 
			{
				echo "<script>alert('Password should contain one uppercase letter,one lowercase letter,one number,one special character and length could not less than 8 or lonnger than 16 character')</script>";
			}
			elseif($_POST['adminPassword'] != $_POST['adminConfirmPassword'])
			{
				echo"<script>alert('Password and Confirm Password are not match!')</script>";
			}
			else
			{
				//Check from database to make sure a user does not exist with the same email
				$sql="SELECT adminEmail FROM admin WHERE adminEmail='$adminEmail'";
				$result=mysqli_query($combine,$sql);
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				if(mysqli_num_rows($result)== 1)
				{
					//message when data had record in database
					echo "<script>alert('Sorry... This email had already used. Please try another.');
						window.location='admin_register.php'</script>";
				}
					//store new record
				else if(isset($_POST['adminFullName']) && isset($_POST['adminEmail']) && isset($_POST['adminPassword']))
				{
					//success store data and display message
					$query = mysqli_query($combine, "INSERT INTO admin
					(adminFullName, adminEmail, adminContactNumber, adminPassword) VALUES
					('$adminFullName', '$adminEmail', '$adminContactNumber', '$adminPassword')");
					if ($query)
					{
						$_SESSION['adminFullName'] = $adminFullName;
						//$_SESSION['success'] = "You are now logged in";
						echo "<script>alert('Your account had been success key in.');
						window.location='admin_login.php'</script>";
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
				<img src = "image/register.jpg" alt = "Admin Register">
			</div>
			
			<form method = "POST" action ="admin_register.php" class = "form">
				<h1 style="text-transform:uppercase; text-align:center">Admin Register</h1>
				
				<label for = "fullName">Full Name</label>
				<input type = "text" id = "adminFullName" name = "adminFullName" placeholder = "Full Name" value= "<?php if(isset($_POST["adminFullName"])) echo $_POST["adminFullName"]; ?>"/><br>
				
				<label for = "email">Email</label>
				<input type = "text" id = "adminEmail" name = "adminEmail" placeholder = "Email" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["adminEmail"])) echo $_POST["adminEmail"]; ?>"/><br>
				
				<label for = "contactNumber">Contact Number</label>
				<input type = "tel" id = "adminContactNumber" name = "adminContactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["adminContactNumber"])) echo $_POST["adminContactNumber"]; ?>"/><br>
				
				<label for = "password">Password</label>
				<input type = "password" id = "adminPassword" name = "adminPassword" placeholder = "Password"  value= "<?php if(isset($_POST["adminPassword"])) echo $_POST["adminPassword"]; ?>"/><br>
				
				<label for = "confirmPassword">Confirm Password</label>
				<input type = "password" id = "adminConfirmPassword" name = "adminConfirmPassword" placeholder = "Confirm Password"><br>
				
				<input type = "submit" style = "float:center" value = "REGISTER" name = "submit"/> 	
			
			</form>
		</div>
	</body>
</html>