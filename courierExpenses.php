<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier Expenses Form</title>
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
				height:722px;
				width:1050px;
				margin:auto;
				margin-top:50px;
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
			
			input[type=text], input[type=date]
			{
				width:94%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			textarea
			{
				width:94%;
				border-bottom:1px solid black;
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
			$expenses = $_POST['expenses'];
			$date = $_POST['date'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			
			if(empty($expenses) || empty($date) || empty($price) || empty($description))
			{
				echo"<script>alert('Please do not let the field empty!')</script>";
			}
			elseif(!is_numeric($price))
			{
				echo"<script>alert('Please enter price in number!')</script>";
			}
			else 
			{
				//success store data and display message
				$query = mysqli_query($combine, "INSERT INTO courierexpenses
				(courierID, expenses, date, price, description) VALUES
				('$courierID','$expenses', '$date', '$price', '$description')");
				if ($query)
				{
					echo "<script>alert('Expenses detail has been successfully key in.');
					window.location='courierExpensesTable.php'</script>";
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
			<form method = "POST" action = "courierExpenses.php" class = "form">
				<h2 style = "color:#21618C;">Courier Expenses Form</h2><br/>
				
				<label for = "expenses">Type of Expenses</label>
				<input type = "text" id = "expenses" name = "expenses" placeholder = "E.g.Rental cost" value= "<?php if(isset($_POST["expenses"])) echo $_POST["expenses"]; ?>"/><br>
				
				<label for = "date">Date</label>
				<input type = "date" id = "date" name = "date" placeholder = "E.g.30.00" value= "<?php if(isset($_POST["date"])) echo $_POST["date"]; ?>"/><br>
			
				<label for = "price">Price(RM)</label>
				<input type = "text" id = "price" name = "price" placeholder = "E.g.5.00" value= "<?php if(isset($_POST["price"])) echo $_POST["price"]; ?>"/><br>
				
				<label for = "description">Remark</label>
				<textarea name = "description" cols="30" rows="10" value= "<?php if(isset($_POST["description"])) echo $_POST["description"]; ?>"></textarea><br>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "SUBMIT" name = "submit"/> 
			</form>
		</div>
	</body>
	
</html>