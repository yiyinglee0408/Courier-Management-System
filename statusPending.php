<!DOCTYPE html>
<html>
	<head>
		<title>Order Status Pending Page</title>
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
		
		$courierID = $_SESSION['courierID'];
	
		if($courierID == '')
		{
			header('location:courier_login.php');
		}
		
		include('courier_sidebar.php');
		include('courier_header.php');
		
		//Select database from user_delivery_details	
		$sql = "SELECT * FROM user_delivery_details WHERE user_delivery_details.courierID='$courierID' AND parcelStatus = 'Pending'";
		$result = mysqli_query($combine,$sql);
		$count = mysqli_num_rows($result);
		$i=1;
	?>
	
	<body>
	
		<h1 style = "color:#21618C; margin-left:330px; padding-top:22px;">Order List</h1><br/>
		
		<table>
			<tr>
				<th colspan = "5">
					Order Status:
					<select name = "toLink" onchange="location = this.value;">
						<option value = "orderList.php">All List</option>
						<option value = "statusPending.php">Pending</option>
						<option value = "statusApprove.php">Approve</option>
						<option value = "statusReject.php">Reject</option>
					</select>
				</th>
			</tr>
			
			<tr>
				<th>No.</th>
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
				<td><?php echo $row['fullName'] ?></td>
				<td><?php echo $row['receiverFullName'] ?></td>
				<td><?php echo $row['parcelStatus'] ?></td>
				<td>
					<?php 
						echo "<button><a href = 'viewDetail1.php?updateID=".$row['deliveryID']."'><i class='bx bx-show' ></i></a></button>";
					?>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
	
	</body>
	
</html>
	