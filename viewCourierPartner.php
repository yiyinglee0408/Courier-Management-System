<!DOCTYPE html>
<html>
	<head>
		<title>Courier Management System</title>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style>
			*
			{
				margin:0;
				padding:0;
			}
			
			.container
			{
				height:2000px;
				width:1200px;
				margin-top:45px;
				margin-bottom:80px;
				margin-left:auto;
				margin-right:auto;
				border-style: solid;
				border-color: #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			table
			{
				border-collapse: collapse;
				width:1100px;
				margin-bottom:auto;
				margin-left:auto;
				margin-right:auto;
				margin-top:20px;
			}
			
			iframe
			{
				border-collapse: collapse;
				width:1100px;
				margin-left:50px;
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
	
	<body>
	
		<?php
			include("courier_management_system.php");
			session_start();
			include('homepage_header.php');
			$ID=$_GET['viewID'];
		?>
		
		<div class = "container">
			<h2 style = "margin-top:25px; margin-left:50px;"><font color = "#21618C">Courier Detail</font></h2>
			
			<?php
				$sql = "SELECT * FROM courier WHERE courierID = '$ID'";
				$result = mysqli_query($combine, $sql);
				while($row=mysqli_fetch_array($result)) 
				{
			?>
					<table>
						<tr>
							<th>Courier Name</th>
							<td><?php  echo $row['courierName'];?></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><?php  echo $row['courierEmail'];?></td>
						</tr>
						<tr>
							<th>Contact Number</th>
							<td><?php  echo $row['courierContactNumber'];?></td>
						</tr>
						<tr>
							<th>Address</th>
							<td><?php  echo $row['autocomplete'];?></td>
						</tr>
						<tr>
							<th>City</th>
							<td><?php  echo $row['locality'];?></td>
						</tr>
						<tr>
							<th>State</th>
							<td><?php  echo $row['administrative_area_level_1'];?></td>
						</tr>
						<tr>
							<th>ZIP Code / Postal Code</th>
							<td><?php  echo $row['postal_code'];?></td>
						</tr>
						<tr>
							<th>Country</th>
							<td><?php  echo $row['country'];?></td>
						</tr>
					</table>
			<?php
				}
			?>
			
			<br>
			
			<?php
				//Select database from shippingrate
				$sql1 = "SELECT * FROM shippingrate WHERE shippingrate.courierID='$ID'";
				$result2 = mysqli_query($combine,$sql1);
				$count = mysqli_num_rows($result2);
			?>
			<h2 style = "margin-top:25px; margin-left:50px;"><font color = "#21618C">Shipping Rate Table</font></h2>
			
			<table>
				<tr>
					<th>Weight(KG)</th>
					<th>Price(RM)</th>
				</tr>
				<?php 
					while($row = mysqli_fetch_array($result2)){
				?>
				<tr>
					<td>
						<?php echo $row['minWeight']?>
						-
						<?php echo $row['maxWeight']?>
					</td>
					<td><?php echo $row['price'] ?></td>
				</tr>
				<?php
					}
				?>
			</table>
			
			<br><br>
			
			<?php
				$result1 = mysqli_query($combine, "SELECT courierID, courier.autocomplete as cAddress FROM courier WHERE courierID='$ID'");
				while($row1=mysqli_fetch_array($result1))
				{
			?>
					<iframe width="1100px" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" 
					src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php echo $row1['cAddress']; ?>" allowfullscreen>
			<?php
				}
			?>
		</div>
		
		<?php
			include('footer.php');
		?>
	
	</body>
	
</html>