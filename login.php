<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
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
				align-items:center;
				background-color:white;
			}
			
			.form h1
			{
				margin:50px;
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
				margin-bottom:20px;
			}
		</style>
		
		<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		if(isset($_POST['submit']))
		{
			$email = mysqli_real_escape_string($combine, $_POST['email']);
			$password = mysqli_real_escape_string($combine, $_POST['password']);
			$email = stripslashes($_POST['email']);
			$password = stripslashes($_POST['password']);
			$valid = true;
			
			if(empty($email) || empty($password))
			{
				echo"<script>alert('Please do not let the field empty !')</script>";
			}
			else if($valid)
			{
				//validation if the email had been record in database
				$sql="SELECT * FROM user WHERE email='$email' AND password='$password' ";
				$result=mysqli_query($combine,$sql);
				$row=mysqli_fetch_array($result);
				$email = $row['email'];
				if(mysqli_num_rows($result)== 1)
				{
					$_SESSION['email'] = $email;
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
			
				<h1 style="text-transform:uppercase">Login</h1>
				
				<p class = "account"><small>Don't have an account? <a href = "register.php" style="color:#2874A6"><strong>Register</strong></a></small></p>
		
				<input type = "email" id = "email" name = "email" placeholder = "Email" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"><br>
				
				<input type = "password" id = "password" name = "password" placeholder = "Password" value= "<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>">
				
				<p style="margin-bottom:20px"><a href = "forgetPassword.php" style="color:#2874A6"><small><strong>Forget Password?</strong></small></a></p>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:center" value = "LOGIN" name = "submit"/> 
				
			</form>
			
			<div class = "image">
				<img src = "image/login3.jpg" alt = "User Login">
			</div>	
		</div>
	</body>
</html>