<!DOCTYPE html>
<html>
	<head>
		<title>User Select Cash Payment Method Page</title>
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
				height:305px;
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
			
			input[type=text]
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
		
		$ID=$_GET['bankID'];
		
		if($userID == '')
		{
			header('location:login.php');
		}
	
		include('user_sidebar.php');
		include('user_header.php');
		
		if(isset($_POST['submitted']))
		{
			$ID=$_GET['bankID'];
			$totalPrice = $_POST['totalPrice'];
			$courierID = $_POST['courierID'];
			$paymentMethod = "Online Banking";
			
			$query=mysqli_query($combine,"insert into payment(userID,courierID,totalPrice,paymentMethod) 
			value('$userID','$courierID','$totalPrice', '$paymentMethod')");
			if ($query) 
			{
				//$msg="Remark and Status has been updated.";
				 echo '<script>alert("You have payment successfully.")</script>';
				 echo "<script>window.location.href ='selectedPaymentMethod.php'</script>";
			}
			else
			{
			   echo '<script>alert("Something Went Wrong. Please try again")</script>';
			}
			
		}
	?>
	
	<body>
	
		<div class = "container">
			<form method = "POST" action = "cashPayment.php" class = "form">
				<h2 style = "color:#21618C;">Online Banking Payment Method</h2><br/>
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
				<h3>Total Price(RM)</h3>
				<input name="totalPrice" id="totalPrice" type="text" value="<?php echo $totalPrice?>" readonly ><br>
				
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
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "PAY" name = "submit"/> 
			</form>
		</div>
	
	</body>
	
</html>