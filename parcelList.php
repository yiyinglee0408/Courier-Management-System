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
			}
			
			body
			{
				background-color:#F4F7F9;
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
			
			select
			{
				width:100%;
				padding: 0.5rem 0;  
                font-size: 13px; 
			}
			
		</style>
	
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
	
		<h1 style = "color:#21618C; margin-left:340px; padding-top:22px;">Track Parcel</h1><br/>
		<table>
			<tr>
				<th>No.</th>
				<th>Tracking Number</th>
				<th>Sender Name</th>
				<th>Recipient Name</th>
				<th>Status</th>
				<th>Update Satus</th>
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
						if($row['parcelStatus'] == 1)
						{
							echo "Item Accepted by Courier";
						}
						elseif($row['parcelStatus'] == 2)
						{
							echo "Parcel Collected";
						}
						elseif($row['parcelStatus'] == 3)
						{
							echo "Enroute to Hub";
						}
						elseif($row['parcelStatus'] == 4)
						{
							echo "Arrived at Hub";
						}
						elseif($row['parcelStatus'] == 5)
						{
							echo "Out for Delivery";
						}
						elseif($row['parcelStatus'] == 6)
						{
							echo "Delivered";
						}
						elseif($row['parcelStatus'] == 7)
						{
							echo "Delivery Failed";
						}
						elseif($row['parcelStatus'] == 8)
						{
							echo "Pickup Failed";
						}
						elseif($row['parcelStatus'] == 9)
						{
							echo "Returned to Hub";
						}
					?>
				</td>
				<?php
					 //Get Update id and status  
					 if (isset($_GET['deliveryID']) && isset($_GET['parcelStatus'])) 
					 {  
						  $deliveryID=$_GET['deliveryID'];  
						  $parcelStatus=$_GET['parcelStatus'];  
						  mysqli_query($combine,"update user_delivery_details set parcelStatus='$parcelStatus' where deliveryID='$deliveryID'");  
						  header("location:parcelList.php");  
						  die();  
					 }  
				?>
				<td>
				
					<select onchange="statusUpdate(this.options[this.selectedIndex].value, '<?php echo $row['deliveryID'] ?>')">
						<option value="1">Item Accepted by Courier</option>
						<option value="2">Parcel Collected</option>
						<option value="3">Enroute to Hub</option>
						<option value="4">Arrived at Hub</option>
						<option value="5">Out for Delivery</option>
						<option value="6">Delivered</option>
						<option value="7">Delivery Failed</option>
						<option value="8">Pickup Failed</option>
						<option value="9">Returned to Hub</option>
					</select>
				</td>
				<td>
					<a href = "viewParcelDetail.php">VIEW</a>
					<a href = "deleteParcel.php">DELETE</a>
					<br><br>
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