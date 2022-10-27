<!DOCTYPE html>
<html>
	<head>
		<title>Status of Item Accepted by Courier Page</title>
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
			
			table
			{
				border-collapse: collapse;
				width:1080px;
				margin-left:330px;
				margin-top:20px;
			}
			
			table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
			}
			
			select
			{
				width:20%;
				padding: 0.5rem 0;  
                font-size: 13px; 
			}
			
			button
			{
				width:45%;
				background-color:#5499C7;
				color:white;
				border:none;
				padding:10px;
				font-size:18px;
			}
			
			button:hover
			{
				background-color:#2874A6;
			}
			
			button a i
			{
				color :white;
			}
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		
		//Select database from user_delivery_details	
		$sql = "SELECT * FROM user_delivery_details WHERE parcelStatus = 'Item Accepted by Courier'";
		$result = mysqli_query($combine,$sql);
		$count = mysqli_num_rows($result);
		$i=1;
			
		include('admin_sidebar.php');
	?>
	
	<body>
	
		<h1 style = "color:#21618C; margin-left:330px; padding-top:22px;">Parcel List</h1><br/>
		
		<table>
			<tr>
				<th colspan = "6">
					Parcel Status :
					<select name="toLink" onchange="location = this.value;">
						<option value = "parcelList">All Parcel</option>
						<option value = "itemAccepted.php">Item Accepted by Courier</option>
						<option value = "parcelCollected.php">Parcel Collected</option>
						<option value = "enrouteHub.php">Enroute to Hub<</option>
						<option value = "arrivedHub.php">Arrived at Hub</option>
						<option value = "outFordelivery.php">Out for Delivery</option>
						<option value = "delivered.php">Delivered</option>
						<option value = "deliveryFailed.php">Delivery Failed</option>
						<option value = "pickUpFailed.php">Pickup Failed</option>
						<option value = "returnHub.php">Returned to Hub</option>
					</select>
				</th>
			</tr>
			
			<tr>
				<th>No.</th>
				<th>Tracking Number</th>
				<th>Sender Name</th>
				<th>Recipient Name</th>
				<th>Current Status</th>
				<th>Action</th>
			</tr>
			
			<?php 
				while($row = mysqli_fetch_array($result)){
			?>
			
			<tr>
				<td><?php echo $i++ ?></td>
				<td><?php echo $row['trackingNumber'] ?></td>
				<td><?php echo $row['fullName'] ?></td>
				<td><?php echo $row['receiverFullName'] ?></td>
				<td><?php echo $row['parcelStatus'] ?></td>
				<td>
					<?php 
						echo "<button><a href = 'viewDetail.php?updateID=".$row['deliveryID']."'><i class='bx bx-show' ></i></a></button>";
					?>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
	
	</body>
	
</html>