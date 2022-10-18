<!DOCTYPE html>
<html>
	<head>
		<title>Admin Login Page</title>
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
				height:585px;
				width: 1100px;
				margin:auto;
				margin-top: 75px;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				width: 50%;
				align-items:left;
				background-color:white;
			}
			
			.form h1
			{
				margin-top:100px;
				margin-bottom:50px;
			}
			
			input[type=text], input[type=password],  input[type=email]
			{
				width:70%;
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
			
			.image
			{
				display:flex;
				justify-content:center;
				align-items:center;
			}
			
			.account
			{
				margin-bottom:30px;
				text-align:center;
			}
		</style>
		
		<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		if(isset($_POST['submit']))
		{
			$fullName = mysqli_real_escape_string($combine, $_POST['fullName']);
			$adminEmail = mysqli_real_escape_string($combine, $_POST['adminEmail']);
			$adminPassword = mysqli_real_escape_string($combine, $_POST['adminPassword']);
			$fullName = stripslashes($_POST['fullName']);
			$adminEmail = stripslashes($_POST['adminEmail']);
			$adminPassword = stripslashes($_POST['adminPassword']);
			$valid = true;
			
			if(empty($adminEmail) || empty($adminPassword))
			{
				echo"<script>alert('Please do not let the field empty !')</script>";
			}
			else if($valid)
			{
				//validation if the admin email had been record in database
				$sql="SELECT * FROM user WHERE adminEmail='$adminEmail' AND adminPassword='$adminPassword' ";
				$result=mysqli_query($combine,$sql);
				$row=mysqli_fetch_array($result);
				$adminID = $row['adminID'];
				if(mysqli_num_rows($result)== 1)
				{
					$_SESSION['fullName'] = $fullName;
					$_SESSION['adminEmail'] = $adminEmail;
					$_SESSION['adminID'] = $adminID;
					echo "<script>alert('You are now logged in.');
						window.location='user_delivery_details.php'</script>";
						return true;
				
				}else {
					echo "<script>alert('Wrong email/password combination.');
					window.location='login.php'</script>";
					return false;
				}
				
			}
		}
	?>
	
	<body>
		
		<div class = "container">
		
			<form method = "POST" action ="login.php" class = "form">
			
				<h1 style="text-transform:uppercase; text-align:center">Admin Login</h1>
				
				<label for = "email" style = "padding-left:85px;">Email</label>
				<center><input type = "email" id = "adminEmail" name = "adminEmail" placeholder = "Email" value= "<?php if(isset($_POST["adminEmail"])) echo $_POST["adminEmail"]; ?>"></center><br><br>
				
				<label for = "password" style = "padding-left:85px;">Password</label>
				<center><input type = "password" id = "adminPassword" name = "adminPassword" placeholder = "Password" value= "<?php if(isset($_POST["adminPassword"])) echo $_POST["adminPassword"]; ?>"></center>
				
				<p style="margin-bottom:20px; text-align:center"><a href = "forgetPassword.php" style="color:#2874A6"><small><strong>Forget Password?</strong></small></a></p>
				
				<center><input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:center" value = "LOGIN" name = "submit"/></center>
				
			</form>
			
			<div class = "image">
				<img src = "image/login3.jpg" alt = "User Login">
			</div>	
		</div>
	</body>
</html>