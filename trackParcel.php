<!DOCTYPE html>
<html>
	<head>
		<title>User Tracking Parcel Page</title>
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
				height:295px;
				width:1050px;
				margin:auto;
				margin-top:45px;
				margin-bottom:5px;
				margin-left:340px;
				border-style: solid;
				border-color: #E9ECEF;
			}
			
			.container1
			{
				height:500px;
				width:1050px;
				margin:auto;
				margin-top:45px;
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
				padding-bottom:45px;
			}
			
			input[type=text]
			{
				width:95%;
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
			
			table
			{
				border-collapse: collapse;
				width:1050px;
				margin-left:340px;
				margin-top:20px;
			}
			
			table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
			}
		
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		
		$userID = $_SESSION['userID'];
	
		if($userID == '')
		{
			header('location:login.php');
		}
		
		include('user_sidebar.php');
		include('user_header.php');
?>
	
	<body>
	
		<div class = "container">
			
			<form method = "POST" action = "trackParcel.php" class = "form">
			
				<h2 style = "color:#21618C;">Track Parcel</h2><br/>
			
				<label for = "trackingNumber">Tracking Number</label>
				<input type = "text" id = "trackingNumber" name = "trackingNumber" placeholder = "Enter Tracking Number"/><br>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "TRACK" name = "submit"/> 
			</form>
			
		</div>
		
		<?php
			if(isset($_POST['submitted']))
			{
				$trackingNumber = $_POST['trackingNumber'];
				$sql="SELECT user_delivery_details.deliveryID as deliveryID, user_delivery_details.parcelStatus as parcelStatus FROM user_delivery_details WHERE user_delivery_details.trackingNumber = '$trackingNumber'";
				$result=mysqli_query($combine,$sql);
				$count = mysqli_num_rows($result);
				
				if($count > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
		?>
						<h3 style = "margin-top:25px; margin-left:340px; padding-top:22px;">Tracking Number : <font color = "#21618C"><?php echo $trackingNumber; ?></font></h3>
						
						<?php
							$deliveryID = $row['deliveryID'];
							$parcelStatus = $row['parcelStatus'];
							$sql="SELECT * FROM parceltracking WHERE deliveryID = '$deliveryID' ORDER BY statusDate DESC";
							$result=mysqli_query($combine,$sql);
							$row = mysqli_num_rows($result);
							
							if($row > 0)
							{	
						?>
								<table>
									<tr>
										<th>Date / Time </th>
										<th>Status </th>
										<th>Remark</th>
									</tr>
									<?php 
										while ($row=mysqli_fetch_array($result)) 
										{ ?>
											<tr>
												<td><?php echo $row['statusDate']?></td>
												<td>
													<?php echo $row['parcelStatus']?>
												</td>
												<td><?php echo $row['remark']?></td>
												
											</tr>
									<?php
										}
									?>
								</table>
								
						<?php		
							}
							else
							{
								echo"<script>alert('No tracking record!')</script>";
							}
						?>	
				<?php	
					}
				?>	
			<?php
				}
				else
				{
					echo"<script>alert('Invalid tracking number!')</script>";
				}
			?>
			
			<div class = "container1">
			
				<?php
					if ($parcelStatus == 'Parcel Collected') 
					{
						$result1 = mysqli_query($combine, "SELECT autocomplete FROM user_delivery_details WHERE user_delivery_details.trackingNumber='$trackingNumber'");
						while($row1=mysqli_fetch_array($result1))
						{
				?>
							<iframe width="100%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php  echo $row1['autocomplete'];?>" allowfullscreen>
				<?php
						}
					}
				?>
				
				<?php
					if($parcelStatus == 'Enroute to Hub')
					{
						$sql1 = "SELECT courier.autocomplete as cAddress, user_delivery_details.autocomplete as uAddress FROM user_delivery_details 
								 LEFT JOIN courier ON courier.courierID = user_delivery_details.courierID
								 WHERE user_delivery_details.trackingNumber='$trackingNumber'";
						$result1 = mysqli_query($combine, $sql1);
						while($row1=mysqli_fetch_array($result1))
						{
				?>
							<iframe width="100%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&&origin=<?php echo $row1['uAddress']; ?>&destination=<?php echo $row1['cAddress']; ?>" allowfullscreen></iframe>
				<?php
						}
					}
				?>
			
				<?php
					if ($parcelStatus == 'Arrived at Hub') 
					{
						$result1 = mysqli_query($combine, "SELECT courier.courierID as cID, courier.autocomplete as cAddress FROM courier INNER JOIN user_delivery_details ON courier.courierID=user_delivery_details.courierID WHERE user_delivery_details.trackingNumber='$trackingNumber'");
						while($row1=mysqli_fetch_array($result1))
						{
				?>
							<iframe width="100%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php echo $row1['cAddress']; ?>" allowfullscreen>
				<?php
						}
					}
				?>
				
				<?php
					if($parcelStatus == 'Out for Delivery')
					{
						$sql1 = "SELECT courier.autocomplete as cAddress, user_delivery_details.receiverAddress as rAddress FROM user_delivery_details 
								 LEFT JOIN courier ON courier.courierID = user_delivery_details.courierID
								 WHERE user_delivery_details.trackingNumber='$trackingNumber'";
						$result1 = mysqli_query($combine, $sql1);
						while($row1=mysqli_fetch_array($result1))
						{
				?>
							<iframe width="100%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&&origin=<?php echo $row1['cAddress']; ?>&destination=<?php echo $row1['rAddress']; ?>" allowfullscreen></iframe>
				<?php
						}
					}
				?>
				
				<?php
					if ($parcelStatus == 'Delivered') 
					{
						$result1 = mysqli_query($combine, "SELECT receiverAddress FROM user_delivery_details WHERE user_delivery_details.trackingNumber='$trackingNumber'");
						while($row1=mysqli_fetch_array($result1))
						{
				?>
							<iframe width="100%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php  echo $row1['receiverAddress'];?>" allowfullscreen>
				<?php
						}
					}
				?>
				
				<?php
					if ($parcelStatus == 'Returned to Hub') 
					{
						$result1 = mysqli_query($combine, "SELECT courier.courierID as cID, courier.autocomplete as cAddress FROM courier INNER JOIN user_delivery_details ON courier.courierID=user_delivery_details.courierID WHERE user_delivery_details.deliveryID='$ID'");
						while($row1=mysqli_fetch_array($result1))
						{
				?>
							<iframe width="96%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php echo $row1['cAddress']; ?>" allowfullscreen>
				<?php
						}
					}
				?>
			
			</div>
			
			<br><br>
		<?php		
			}
		?>
	
	</body>
	
</html>
