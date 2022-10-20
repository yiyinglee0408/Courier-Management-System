<!DOCTYPE html>
<html>
	<head>
		<title>User Payment Page</title>
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
				height:739px;
				width: 1050px;
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
			
			input[type=text], input[type=password], input[type=email], input[type=tel], input[type=month]
			{
				width:94%;
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
		
		if(isset($_POST['submitted']))
		{
			$fullName =  $_POST['fullName'];
			$email =  $_POST['email'];
			$contactNumber =  $_POST['contactNumber'];
			$cardNumber =  $_POST['cardNumber'];
			$validDate =  $_POST['validDate'];
			$cardCVC =  $_POST['cardCVC'];
		}
	?>
	
	<?php
		include('user_sidebar.php');
	?>
	
	<body>
	
		<h1>Payment</h1>
	
		<div class = "container">
		
			<form method = "POST" action = "payment.php" class = "form">
			
				<h3 style = "color:#21618C">Payment</h3><br/>
				
				<label for = "fullName">Cardholder's Name</label>
				<input type = "text" id = "fullName" name = "fullName" placeholder = "Cardholder's Name" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/><br/>
					
				<label for = "email">Email</label>
				<input type = "text" id = "email" name = "email" placeholder = "E.g.user@gmail.com" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"/><br>
				
				<label for = "contactNumber">Contact Number</label>
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "E.g.012-4536636" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/>
				
				<label for = "cardNumber">Card Number</label>
				<input type = "password" id = "cardNumber" name = "cardNumber" placeholder = "E.g.1111-2222-3333-4444" value= "<?php if(isset($_POST["cardNumber"])) echo $_POST["cardNumber"]; ?>"/>
				
				<label for = "validDate">Valid thru</label>
				<input type = "month" id = "validDate" name = "validDate" min = "2022-10" placeholder = "E.g.October 2022" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["validDate"])) echo $_POST["validDate"]; ?>"/><br>
				
				<label for = "cardCVC">CVV / CVC</label>
				<input type = "password" id = "cardCVC" name = "cardCVC" placeholder = "E.g.123" value= "<?php if(isset($_POST["cardCVC"])) echo $_POST["cardCVC"]; ?>"/><br>
			
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "SUBMIT" name = "submit"/> 
				
			</form>
		
		</div>
	
	</body>
	
</html>