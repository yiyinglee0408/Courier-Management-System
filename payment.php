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
			}
			
			body
			{
				background-color:#F4F7F9;
			}
			
			.container
			{
				height:542px;
				width: 1050px;
				margin:auto;
				margin-top:25px;
				margin-bottom:50px;
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
		
		$ID=$_GET['updateID'];
		
		if($userID == '')
		{
			header('location:login.php');
		}
		
		include('user_sidebar.php');
		include('user_header.php');
		
		if(isset($_POST['submitted']))
		{
			$ID=$_GET['updateID'];
			$fullName =  $_POST['fullName'];
			$email =  $_POST['email'];
			$contactNumber =  $_POST['contactNumber'];
			$totalPrice = $_POST['totalPrice'];
			$courierID = $_POST['courierID'];
			$paymentMethod = "Debit Card";
			
			$fullName = mysqli_real_escape_string($combine, $fullName);
			$email = mysqli_real_escape_string($combine, $email);
			$contactNumber = mysqli_real_escape_string($combine, $contactNumber);
			
			if(empty($fullName) || empty($email) || empty($contactNumber))
			{
				echo"<script>alert('Please do not let the field empty !')</script>";
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				echo"<script>alert('Please enter a valid email!')</script>";
			}
			else
			{
				$query = mysqli_query($combine, "INSERT INTO payment
				(userID, courierID, fullName, email, contactNumber, totalPrice, paymentMethod) VALUES
				('$userID', '$courierID', '$fullName', '$email', '$contactNumber', '$totalPrice', '$paymentMethod')");
				if ($query)
				{
					//$_SESSION['success'] = "You are now logged in";
					echo "<script>alert('You have been payment successfully');
					window.location='user_delivery_details.php'</script>";
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
		
			<form method = "POST" action = "payment.php" class = "form">
			
				<h3 style = "color:#21618C">Debit Card Payment</h3><br/>
				
				<label for = "fullName">Cardholder's Name</label>
				<input type = "text" id = "fullName" name = "fullName" placeholder = "Cardholder's Name" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/><br/>
					
				<label for = "email">Email</label>
				<input type = "text" id = "email" name = "email" placeholder = "E.g.user@gmail.com" pattern = "[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"/><br>
				
				<label for = "contactNumber">Contact Number</label>
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "E.g.012-4536636" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/>
				
				<?php
					$sql1 = "SELECT courierID FROM user_delivery_details WHERE user_delivery_details.deliveryID = '$ID'";
					$result1 = mysqli_query($combine, $sql1);
					while($row1 = mysqli_fetch_array($result1))
					{
				?>
						<input name="courierID" id="courierID" type="hidden" value="<?php echo $row1['courierID']?>">
				<?php
					}
				?>
				
				<?php
					$sql = "SELECT parcelWeight, courierID from user_delivery_details WHERE deliveryID = '$ID'";
					$result=mysqli_query($combine,$sql);
					while($row = mysqli_fetch_array($result))
					{
						$target = $row['courierID'];
						$weight = $row['parcelWeight'];
						$sql2 = "SELECT minWeight, maxWeight, price FROM shippingrate WHERE courierID='$target'";
						$result2 = mysqli_query($combine,$sql2);
						  
						  while($row2 = mysqli_fetch_array($result2))
						 {
							$minWeight = $row2['minWeight'];
							$maxWeight = $row2['maxWeight'];
						
							if($weight >= $minWeight && $weight <= $maxWeight)
							{
								$totalPrice = $row2['price'];
							}
							
							//$totalPrice = $row2['price'];
						
						}
					}
				?>
				
				<label for = "totalPrice">Total Price(RM)</label>
				<input name="totalPrice" id="totalPrice" type="text" value="<?php print $totalPrice?>" readonly >
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "SUBMIT" name = "submit"/> 
				
			</form>
		
		</div>
	
	</body>
	
</html>