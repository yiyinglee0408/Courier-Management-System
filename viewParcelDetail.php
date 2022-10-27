<!DOCTYPE html>
<html>
	<head>
		<title>View Parcel Detail Page</title>
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
			
			.container
			{
				height:2422px;
				width:1050px;
				margin:auto;
				margin-top:25px;
				margin-bottom:80px;
				margin-left:340px;
				border-style: solid;
				border-color: #E9ECEF;
				background-color:white;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				background-color:white;
				margin-left:35px;
				padding-bottom:50px;
			}
			
			table
			{
				border-collapse: collapse;
				width:93%;
				margin-left:35px;
				margin-top:20px;
			}
			
			 table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:20%;
				text-transform:uppercase;
				background-color:#2874A6;
				color:white;
				font-weight:600;
				border:none;
				padding:1rem;
				border-radius:8px;
				font-size:15px;
				letter-spacing:0.5px;
				margin-bottom:20px;
			}
			
			input[type=submit]:hover
			{
				background-color:#5499C7;
			}
			
			select
			{
				width:96.5%;
				padding: 15px 0;  
                font-size: 14px; 
			}
		</style>
	</head>
	
	<?php
		include("courier_management_system.php");
		session_start();
		
		include('admin_sidebar.php');
	?>
	
	<body>
		<h3>View Parcel</h3>
		<div class = "container">
		
			<?php 
				$deliveryID=$_GET['deliveryID'];
				$sql = "SELECT * FROM user_delivery_details WHERE deliveryID = '$deliveryID'";
				$result = mysqli_query($combine, $sql);
				$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
			?>
			
			<p style = "margin-top:25px; margin-left:35px;"><strong><font color = "#21618C">Tracking Number : </font></strong><?php echo $row["trackingNumber"]; ?></p>
			<p style = "margin-top:25px; margin-left:35px;"><strong><font color = "#21618C">Date : </font></strong><?php echo $row["dateCreated"]; ?></p>
			
			<table>
				<tr>
					<th style = "text-align:center" colspan = "2"><font color = "#21618C">Sender Details</font></th>
				</tr>
				
				<tr>
					<th>Name</th>
					<td><?php  echo $row['fullName'];?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php  echo $row['email'];?></td>
				</tr>
				<tr>
					<th>Contact Number</th>
					<td><?php  echo $row['contactNumber'];?></td>
				</tr>
				<tr>
					<th>Address</th>
					<td><?php  echo $row['autocomplete'];?></td>
				</tr>
				<tr>
					<th>Apartment, Unit, Suite, or Floor(Optional)</th>
					<td><?php  echo $row['apartmentUnit'];?></td>
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

			<table>
				<tr>
					<th style = "text-align:center" colspan = "2"><font color = "#21618C">Receiver Details</font></th>
				</tr>
				
				<tr>
					<th>Name</th>
					<td><?php  echo $row['receiverFullName'];?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php  echo $row['receiverEmail'];?></td>
				</tr>
				<tr>
					<th>Contact Number</th>
					<td><?php  echo $row['receiverContactNumber'];?></td>
				</tr>
				<tr>
					<th>Address</th>
					<td><?php  echo $row['receiverAddress'];?></td>
				</tr>
				<tr>
					<th>Apartment, Unit, Suite, or Floor(Optional)</th>
					<td><?php  echo $row['receiverApartmentUnit'];?></td>
				</tr>
				<tr>
					<th>City</th>
					<td><?php  echo $row['receiverCity'];?></td>
				</tr>
				<tr>
					<th>State</th>
					<td><?php  echo $row['receiverState'];?></td>
				</tr>
				<tr>
					<th>ZIP Code / Postal Code</th>
					<td><?php  echo $row['receiverPostalCode'];?></td>
				</tr>
				<tr>
					<th>Country</th>
					<td><?php  echo $row['receiverCountry'];?></td>
				</tr>
			</table>
			
			<table>
				<tr>
					<th style = "text-align:center" colspan = "2"><font color = "#21618C">Parcel Details</font></th>
				</tr>
				
				<tr>
					<th>Weight(kg)</th>
					<td><?php  echo $row['parcelWeight'];?></td>
				</tr>
				<tr>
					<th>Content</th>
					<td><?php  echo $row['parcelContent'];?></td>
				</tr>
				<tr>
					<th>Value(MYR)</th>
					<td><?php  echo $row['parcelValue'];?></td>
				</tr>
				<tr>
					<th>Status</th>
					<td>
						<?php
							echo $pSatus = $row['parcelStatus'];
							if($pSatus == 1)
							{
								echo "Item Accepted by Courier";
							}
							elseif($pSatus == 2)
							{
								echo "Parcel Collected";
							}
							elseif($pSatus == 3)
							{
								echo "Enroute to Hub";
							}
							elseif($pSatus == 4)
							{
								echo "Arrived at Hub";
							}
							elseif($pSatus == 5)
							{
								echo "Out for Delivery";
							}
							elseif($pSatus == 6)
							{
								echo "Delivered";
							}
							elseif($pSatus == 7)
							{
								echo "Delivery Failed";
							}
							elseif($pSatus == 8)
							{
								echo "Pickup Failed";
							}
							elseif($pSatus == 9)
							{
								echo "Returned to Hub";
							}
						?>
					</td>
				</tr>
			</table>
			
			<?php
					$sql = "SELECT parceltracking.parcelStatus as ps,parceltracking.statusDate FROM user_delivery_details left join parceltracking on parceltracking.trackingID=user_delivery_details.deliveryID where user_delivery_details.deliveryID='$deliveryID'";
					$result = mysqli_query($combine,$sql);
					$count = mysqli_num_rows($result);
					$i =1;
			?>
			
			<table>
				<tr>
					<th style = "text-align:center" colspan = "3"><font color = "#21618C">Parcel Current Status</font></th>
				</tr>
				<tr>
					<th>No.</th>
					<th>Date / Time</th>
					<th>Status</th>
				</tr>
				<?php
					while($row = mysqli_fetch_array($result)){
				?>
				<tr>
					<td><?php echo $i++ ?></td>
					<td><?php  echo $row['statusDate'];?></td>
					<td>
						<?php
							if($row['ps'] == 1)
							{
								echo "Item Accepted by Courier";
							}
							elseif($row['ps'] == 2)
							{
								echo "Parcel Collected";
							}
							elseif($row['ps'] == 3)
							{
								echo "Enroute to Hub";
							}
							elseif($row['ps'] == 4)
							{
								echo "Arrived at Hub";
							}
							elseif($row['ps'] == 5)
							{
								echo "Out for Delivery";
							}
							elseif($row['ps'] == 6)
							{
								echo "Delivered";
							}
							elseif($row['ps'] == 7)
							{
								echo "Delivery Failed";
							}
							elseif($row['ps'] == 8)
							{
								echo "Pickup Failed";
							}
							elseif($row['ps'] == 9)
							{
								echo "Returned to Hub";
							}
						?>
					</td>
				</tr>
				
				<?php
					}
				?>
			</table>
			
			<br><br><br>
			
			<?php
				if(isset($_POST['submitted']))
				{
					$deliveryID=$_GET['deliveryID'];
					$parcelStatus = $_POST['status'];
					
					 $query = mysqli_query($combine,"insert into parceltracking(trackingID,parcelStatus) value('$deliveryID','$parcelStatus')");
					 mysqli_query($combine, "update user_delivery_details set parcelStatus='$parcelStatus' where deliveryID='$deliveryID'");
					
					if ($query) 
					{
						$msg="Remark and Status has been updated.";
						echo '<script>alert("Remark and Status has been updated.")</script>';
						echo "<script>window.location.href ='parcelList.php'</script>";
					}
					else
					{
					   echo '<script>alert("Something Went Wrong. Please try again")</script>';
					}
				}
			?>
			
			<form method = "POST" class = "form">
				<h2 style = "color:#21618C">Update Status</h2><br/>
				<?php
					if($pSatus != 6)
					{
				?>
						<p>
							<select name = "status">
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
							<br><br>
							<input type = "hidden" name = "submitted" value = "true"/>
							<input type = "submit" value = "UPDATE STATUS" name = "submit"/> 
						</p>
				<?php
					}
				?>
			</form>
		</div>
	
	</body>
	
</html>