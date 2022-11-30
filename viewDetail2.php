<!DOCTYPE html>
<html>
	<head>
		<title>View Parcel Detail and Update Status Page</title>
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
				height:2950px;
				width:1050px;
				margin:auto;
				margin-top:45px;
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
			
			select,textarea
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
			
			$courierID = $_SESSION['courierID'];
	
			if($courierID == '')
			{
				header('location:courier_login.php');
			}
			
			include('courier_sidebar.php');
			include('courier_header.php');
			
			if(isset($_POST['submitted']))
			{
				$ID=$_GET['updateID'];
				$parcelStatus = $_POST['parcelStatus'];
				$remark = $_POST['remark'];
				
				$query=mysqli_query($combine,"insert into parceltracking(deliveryID,parcelStatus,remark) value('$ID',' $parcelStatus','$remark')");
			    $query.=mysqli_query($combine, "update user_delivery_details set parcelStatus='$parcelStatus' where deliveryID='$ID'");
				if ($query) 
				{
					//$msg="Remark and Status has been updated.";
					 echo '<script>alert("Parcel Status has been updated.")</script>';
					 echo "<script>window.location.href ='parcelList.php'</script>";
			    }
			    else
				{
				   echo '<script>alert("Something Went Wrong. Please try again")</script>';
				}
			}
	?>
	
	<body>
	
		<div class = "container">
			<h4 style = "margin-top:25px; margin-left:35px;"><font color = "#21618C">Parcel Detail</font></h4>
			
			<?php
				$ID=$_GET['updateID'];
				$sql = "SELECT * FROM user_delivery_details WHERE deliveryID = '$ID'";
				$result = mysqli_query($combine, $sql); 
				$i = 1;
				while($row=mysqli_fetch_array($result)) 
				{
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
							<th>Status</th>
							<td>
								<?php
									if($row['parcelStatus'] == '0')
									{
										echo "Pending";
									}
									else
									{
										echo $pstatus=$row['parcelStatus'];
									}
								?>
							</td>
						</tr>
					</table>
					
					<?php
						if($row['parcelStatus'] != '0')
						{
							$result = mysqli_query($combine,"select parceltracking.parcelStatus as ps,parceltracking.statusDate, parceltracking.remark from user_delivery_details left join parceltracking on parceltracking.deliveryID=user_delivery_details.deliveryID where user_delivery_details.deliveryID='$ID'");
							$i = 1;
						
					?>
					
							<table>
								<tr>
									<th style = "text-align:center" colspan = "4"><font color = "#21618C">Parcel Current Status</font></th>
								</tr>
								<tr>
									<th>No.</th>
									<th>Status</th>
									<th>Remark</th>
									<th>Date & Time</th>
								</tr>
								<?php
									while($row=mysqli_fetch_array($result))
									{ 
								?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $row['ps'];?></td>
										<td><?php echo $row['remark'];?></td>
										<td><?php echo $row['statusDate'];?></td>
									</tr>
								<?php
									}
								?>
					</table>
					<br><br>
					<?php
						}
					?>
					
					<?php
						if($pstatus!='Delivered')
						{
						
					?>
							<form method = "POST" name = "submitted" class = "form">
								<h2 style = "color:#21618C">Update Current Status</h2><br>
								<select name = "parcelStatus">
									 <option value="Item Accepted by Courier">Item Accepted by Courier</option>
									 <option value="Order Rejected" style="color: red">Order Rejected</option>
									 <option value="Parcel Collected">Parcel Collected</option>
									 <option value="Enroute to Hub">Enroute to Hub</option>
									 <option value="Arrived at Hub">Arrived at Hub</option>
									 <option value="Out for Delivery">Out for Delivery</option>
									 <option value="Delivered" style="color: green">Delivered</option>
									 <option value="Delivery Failed" style="color: red">Delivery Failed</option>
									 <option value="Pickup Failed" style="color: red">Pickup Failed</option>
									  <option value="Returned to Hub">Returned to Hub</option>
								</select><br>
								
								<label for = "remark">Remark</label>
								<textarea name = "remark" cols="30" rows="10"></textarea><br>
								<input type = "hidden" name = "submitted" value = "true"/>
								<input type = "submit" value = "UPDATE STATUS" name = "submit"/> <br><br>
								
								<?php
									if ($pstatus == 'Parcel Collected') 
									{
										$result1 = mysqli_query($combine, "SELECT autocomplete FROM user_delivery_details WHERE user_delivery_details.deliveryID='$ID'");
										while($row1=mysqli_fetch_array($result1))
										{
								?>
											<iframe width="96%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" 
											src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php  echo $row1['autocomplete'];?>" allowfullscreen>
								<?php
										}
									}
								?>
								
								<?php
									if($pstatus == 'Enroute to Hub')
									{
										$sql1 = "SELECT courier.autocomplete as cAddress, user_delivery_details.autocomplete as uAddress FROM user_delivery_details 
												 LEFT JOIN courier ON courier.courierID = user_delivery_details.courierID
												 WHERE user_delivery_details.deliveryID='$ID'";
										$result1 = mysqli_query($combine, $sql1);
										while($row1=mysqli_fetch_array($result1))
										{
								?>
											<iframe width="96%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&&origin=<?php echo $row1['uAddress']; ?>&destination=<?php echo $row1['cAddress']; ?>" allowfullscreen></iframe>
								<?php
										}
									}
								?>
								
								<?php
									if ($pstatus == 'Arrived at Hub') 
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
								
								<?php
									if($pstatus == 'Out for Delivery')
									{
										$sql1 = "SELECT courier.autocomplete as cAddress, user_delivery_details.receiverAddress as rAddress FROM user_delivery_details 
												 LEFT JOIN courier ON courier.courierID = user_delivery_details.courierID
												 WHERE user_delivery_details.deliveryID='$ID'";
										$result1 = mysqli_query($combine, $sql1);
										while($row1=mysqli_fetch_array($result1))
										{
								?>
											<iframe width="96%" height="500" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&&origin=<?php echo $row1['cAddress']; ?>&destination=<?php echo $row1['rAddress']; ?>" allowfullscreen></iframe>
								<?php
										}
									}
								?>
								
								<?php
									if ($pstatus == 'Returned to Hub') 
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
							
							</form>
	
					<?php
						}
					?>
					
					<?php
						if ($pstatus == 'Delivered') 
						{
							$result1 = mysqli_query($combine, "SELECT receiverAddress FROM user_delivery_details WHERE user_delivery_details.deliveryID='$ID'");
							while($row1=mysqli_fetch_array($result1))
							{
					?>
								<iframe width="93%" height="500" style = "margin-left:35px;" frameborder="0" style="border:0" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCwr5WOvRpeGepLWE2r8Iw5PisWLqFfY9M&q=<?php  echo $row1['receiverAddress'];?>" allowfullscreen>
					<?php
							}
						}
					?>
					
			<?php
				}
			?>
		</div>
	</body>
	
</html>