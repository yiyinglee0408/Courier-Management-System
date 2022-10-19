<!DOCTYPE html>
<html>

	<head>
		<title>Forget Password Page</title>
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
			
			.container
			{
				height:585px;
				width: 800px;
				margin:auto;
				margin-top: 100px;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				align-items:left;
				background-color:white;
			}
			
			input[type=password],  input[type=email]
			{
				width:80%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:80%;
				text-transform:uppercase;
				background-color:#2874A6;
				color:white;
				font-weight:600;
				border:none;
				padding:1rem;
				border-radius:8px;
				font-size:15px;
				letter-spacing:0.5px;
				margin-bottom:50px;
			}
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
	?>
	
	<body>
	
		<div class = "container">
		
			<form action = "" method = "POST" class = "form">
			
				<h1 style="text-transform:uppercase; text-align:center; margin-top:40px; margin-bottom:30px">Forget Password</h1>
				
				<label for = "email" style = "padding-left:85px;">Email</label>
				<center><input type = "email" id = "email" name = "email" placeholder = "Email" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"></center><br><br>
				
				<label for = "password" style = "padding-left:85px;">New Password</label>
				<center><input type = "password" id = "password" name = "password" placeholder = "Enter New Password" value= "<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>"></center><br><br>
				
				<label for = "confirmPassword" style = "padding-left:85px;">Confirm Password</label>
				<center><input type = "password" id = "confirmPassword" name = "confirmPassword" placeholder = "Confirm Password"></center><br>
			
				<center><input type="submit" style="float:center;" value='SUBMIT' name="ChangePassword"/><center>
			
			</form>
		
		</div>
	
	</body>

</html>