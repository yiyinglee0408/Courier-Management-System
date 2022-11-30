<!DOCTYPE html>
<html>
	<head>
	
		<title>Courier View Feedback List</title>
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
				height:540px;
				width:1050px;
				margin:auto;
				margin-top:50px;
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
				padding-left:50px;
				padding-top:50px;
				padding-bottom:50px;
			}
			
			table
			{
				border-collapse: collapse;
				width:94%;
				margin-bottom:20px;
			}
			
			 table,td, th 
			{
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 15px;
			  background-color:white;
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
			
			textarea
			{
				width:94%;
				border-bottom:1px solid black;
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
		?>
	
	<body>
		
		<div class = "container">
			<?php
				$ID=$_GET['solveID'];
				$sql = "SELECT * FROM customerservice WHERE customerservice.ID='$ID'";
				$result = mysqli_query($combine,$sql);
				$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
			?>
		
			<form method = "GET" action = "solveCustomerRequest2.php" class = "form" enctype="multipart/form-data">
				<h2 style = "color:#21618C;">Courier Solve Customer Problem</h2><br/>
				
				<table>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Contact Number</th>
						<th>Tracking Number</th>
						<th>Description</th>
					</tr>
					
					<tr>
						<td><?php echo $row['fullName']?></td>
						<td><?php echo $row['email'] ?></td>
						<td><?php echo $row['contactNumber']?></td>
						<td><?php echo $row['trackingNumber']?></td>
						<td><?php echo $row['description']?></td>
					</tr>

				</table>
				
				<?php
					echo"<input type='hidden' id='ID' name='ID' value='".$row['ID']."'>";  
					echo "<textarea name='courierAction' id = 'courierAction' rows='8' cols='40' placeholder='Enter your reply here!'>".$row['courierAction']."</textarea>";					
				?>
				<br><br>
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" style = "float:right" value = "SUBMIT" name = "submit"/>
			</form>
		</div>
		
	</body>
		
</html>
			