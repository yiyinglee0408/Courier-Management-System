<!DOCTYPE html>
<html>
	<head>
	
		<title>Parcel List</title>
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
				width:100%;
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
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();

		//Select database from user_delivery_details	
		$sql = "SELECT * FROM user_delivery_details";
		$result = mysqli_query($combine,$sql);
		$count = mysqli_num_rows($result);
		$i=1;
		
		include('admin_sidebar.php');
	?>
	
		<h1 style = "color:#21618C; margin-left:330px; padding-top:22px;">Parcel List</h1><br/>
		<table>
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
				<td>
					<?php
						if($row['parcelStatus'] == '0')
						{
							echo "Parcel haven't pick up";
						}
						else
						{
							echo $row['parcelStatus'];
						}
					?>
				</td>
				
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
		
		<script type = "text/javascript">
			function statusUpdate(value,deliveryID)
			{
				//alert(deliveryID);
				let url = "http://localhost/cms1/parcelList.php";
				window.location.href= url+"?deliveryID="+deliveryID+"&parcelStatus="+value;  
			}
		</script>
	
</html>