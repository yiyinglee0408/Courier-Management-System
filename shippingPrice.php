<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier Shipping Price List</title>
		<meta charset = "utf-8">
		
		<style>
		
			*
			{
				margin:0;
				padding:0;
			}
			
			body
			{
				background-color:#F4F7F9;
			}
			
			.container
			{
				height:492px;
				width:1050px;
				margin:auto;
				margin-top:45px;
				margin-bottom:80px;
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
			
			input[type=text], input[type=number]
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
		
		$courierID = $_SESSION['courierID'];
	
		if($courierID == '')
		{
			header('location:courier_login.php');
		}
		
		include('courier_sidebar.php');
		include('courier_header.php');
		
		if(isset($_POST['submitted']))
		{
			$minWeight = $_POST['minWeight'];
			$maxWeight = $_POST['maxWeight'];
			$price = $_POST['price'];
			
			if(empty($minWeight) || empty($maxWeight) || empty($price))
			{
				echo"<script>alert('Please do not let the field empty!')</script>";
			}
			elseif(!is_numeric($price) || !is_numeric($minWeight) || !is_numeric($maxWeight))
			{
				echo"<script>alert('Please enter in number!')</script>";
			}
			else 
			{
				 //success store data and display message
				$query = mysqli_query($combine, "INSERT INTO shippingrate
				(courierID, minWeight, maxWeight, price) VALUES
				('$courierID','$minWeight', '$maxWeight', '$price')");
				if ($query)
				{
					$_SESSION['fullName'] = $fullName;
					//$_SESSION['success'] = "You are now logged in";
					echo "<script>alert('Shipping rate has been successfully key in.');
					window.location='shippingRateTable.php'</script>";
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
			<form method = "POST" action = "shippingPrice.php" class = "form">
				<h2 style = "color:#21618C;">Shipping Price</h2><br/>
				
				<label for = "minWeight">Minimun Weight (KG)</label>
				<input type = "text" id = "minWeight" name = "minWeight" placeholder = "E.g.0.00" value= "<?php if(isset($_POST["minWeight"])) echo $_POST["minWeight"]; ?>"/><br>
				
				<label for = "maxWeight">Maximum Weight (KG)</label>
				<input type = "text" id = "maxWeight" name = "maxWeight" placeholder = "E.g.30.00" value= "<?php if(isset($_POST["maxWeight"])) echo $_POST["maxWeight"]; ?>"/><br>
			
				<label for = "price">Price(RM)</label>
				<input type = "text" id = "price" name = "price" placeholder = "E.g.5.00" value= "<?php if(isset($_POST["price"])) echo $_POST["price"]; ?>"/><br>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "SUBMIT" name = "submit"/> 
			</form>
		</div>
	</body>
	
</html>