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
		
		if(isset($_POST['ChangePassword']))
		{
			$email=$_POST['email'];
			$NewPassword=$_POST['NewPassword'];
			$CNewPassword=$_POST['CNewPassword'];
			
			if(empty($email) || empty($NewPassword) || empty($CNewPassword))
			{
				echo"<script>alert('Please do not let the field empty !')</script>";
			}
			elseif (strlen($NewPassword) <='8' || strlen($NewPassword) >'16' || !preg_match("#[0-9]+#",$NewPassword) || !preg_match("#[A-Z]+#",$NewPassword) || !preg_match("#[a-z]+#",$NewPassword) || !preg_match("#[^\w]+#",$NewPassword)) 
			{
				echo "<script>alert('Password should contain one uppercase letter,one lowercase letter,one number,one special character and length could not less than 8 or lonnger than 16 character')</script>";
			}
			elseif($_POST['NewPassword'] != $_POST['CNewPassword'])
			{
				echo"<script>alert('Password and Confirm Password are not match!')</script>";
			}
			else
			{
				$sql="SELECT email FROM user WHERE email='$email'";
				$result=mysqli_query($combine,$sql);
				$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				if(mysqli_num_rows($result)== 1)
				{
					mysqli_query($combine, "UPDATE user set password='" . $_POST["NewPassword"] . "' WHERE email='" . $_POST["email"] . "'");
					echo"<script>alert('Password change successfully.');
					window.location='login.php'</script>";
				}
				else{
					echo"<script>alert('Your email not found.')</script>";
				}
			}
		}
	?>
	
	<body>
	
		<div class = "container">
		
			<form action = "" method = "POST" class = "form">
			
				<h1 style="text-transform:uppercase; text-align:center; margin-top:40px; margin-bottom:30px">Forget Password</h1>
				
				<label for = "email" style = "padding-left:85px;">Email</label>
				<center><input type = "email" id = "email" name = "email" placeholder = "Email" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"></center><br><br>
				
				<label for = "password" style = "padding-left:85px;">New Password</label>
				<center><input type = "password" id = "NewPassword" name = "NewPassword" placeholder = "Enter New Password" value= "<?php if(isset($_POST["NewPassword"])) echo $_POST["NewPassword"]; ?>"></center><br><br>
				
				<label for = "confirmPassword" style = "padding-left:85px;">Confirm New Password</label>
				<center><input type = "password" id = "CNewPassword" name = "CNewPassword" placeholder = "Confirm New Password"></center><br>
			
				<center><input type="submit" style="float:center;" value='SUBMIT' name="ChangePassword"/><center>
			
			</form>
		
		</div>
	
	</body>

</html>