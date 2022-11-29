<!DOCTYPE html>
<html>
	<head>
		<title>Customer Service</title>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style>
			*
			{
				margin:0;
				padding:0;
				box-sizing:border-box;
			}
			
			.container
			{
				display:flex;
				height:1010px;
				width:1200px;
				margin-top:45px;
				margin-bottom:50px;
				margin-left:auto;
				margin-right:auto;
				border:2px solid #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
				border-radius : 15px;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				width: 50%;
				align-items:right;
				background-color:#FDFEFE;
			}
			
			.form h1
			{
				text-transform:uppercase;
				text-align:center;
				color:#21618C; 
				font-weight:600;
				margin:35px;
			}
			
			input[type=text], input[type=email], input[type=tel], select
			{
				width:95%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
				align-items:center;
				margin-left:40px;
			}
			
			input[type=submit]
			{
				display:inline-block;
				width:95%;
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
				margin-left:40px;
			}
			
			input[type=submit]:hover
			{
				background-color:#5499C7;
			}
			
			.image
			{
				display:flex;
				justify-content:center;
				align-items:center;
			}
			
			.image img
			{
				width:550px;
				height:1000px;
			}
			
			textarea
			{
				width:95%;
				padding: 15px 0;  
                font-size: 14px; 
				margin-left:40px;
			}
		</style>
	</head>
	
	<body>
		<?php
			include("courier_management_system.php");
			session_start();
			include('homepage_header.php');
			
			if(isset($_POST['submitted']))
			{
				$trackingNumber = $_POST['trackingNumber'];
				$courierID = $_POST['courierID'];
				$fullName = $_POST['fullName'];
				$email = $_POST['email'];
				$contactNumber = $_POST['contactNumber'];
				$description = $_POST['description'];
				
				$query=mysqli_query($combine,"insert into customerService(fullName,email,contactNumber,courierID,trackingNumber,description) 
				value('$fullName',' $email','$contactNumber','$courierID',' $trackingNumber','$description')");
				if ($query) 
				{
					//$msg="Remark and Status has been updated.";
					 echo '<script>alert("Thank you for your comment.")</script>';
					 echo "<script>window.location.href ='customerService.php'</script>";
			    }
			    else
				{
				   echo '<script>alert("Something Went Wrong. Please try again")</script>';
				}
			}
		?>
		
		<div class = "container">
		
			<div class = "image">
				<img src = "image/service1.jpg" alt = "Customer Service">
			</div>
			
			<form method = "POST" action = "customerService.php" class = "form">
				<h1>Customer Service</h1>
				
				<label for = "fullName" style = "padding-left:40px;">Full Name</label>
				<center><input type = "text" id = "fullName" name = "fullName" placeholder = "Full Name" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/></center><br><br>
				
				<label for = "email" style = "padding-left:40px;">Email</label>
				<input type = "email" id = "email" name = "email" placeholder = "Email" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"><br><br>
				
				<label for = "contactNumber" style = "padding-left:40px;">Contact Number</label>
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/><br><br>
				
				<label for = "courierID" style = "padding-left:40px;">Select Courier Company</label>
				<select name = "courierID" id = "courierID" onchange="select()">
					<option value="">Select Courier Company</option>
					<?php 
						$sql1 = "SELECT * FROM courier";
						$result1=mysqli_query($combine,$sql1);
						while ($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
						{
							$courierID = $row['courierID'];
							$courierName = $row['courierName'];
					?>
							<option value="<?php echo $courierID;?>"><?php echo $courierName;?></option>
					<?php
						} 
					?>
				</select><br><br>
				
				<label for = "trackingNumber" style = "padding-left:40px;">Tracking Number</label>
				<input type = "text" id = "trackingNumber" name = "trackingNumber" placeholder = "Enter Your Tracking Number" value= "<?php if(isset($_POST["trackingNumber"])) echo $_POST["trackingNumber"]; ?>"/><br><br>
				
				<label for = "description" style = "padding-left:40px;">Description</label><br>
				<textarea name = "description" cols="30" rows="10" placeholder="Description..." value= "<?php if(isset($_POST["description"])) echo $_POST["description"]; ?>"></textarea><br>
				
				<input type = "hidden" name = "submitted" value = "true"/>
				<input type = "submit" value = "submit" name = "submit"/> 
			</form>
		</div>
		
		<?php
			include('footer.php');
		?>
	</body>
	
	<script>  
		function select()
		{
			var x = document.getElementById("courierID").value;
			
			$.ajax({
				url:"showShippingRate.php",
				method:"POST",
				data:{
					id:x
				},
				success:function(data)
				{
					$("#detail").html(data);
				}
			})
		}
	</script>
	
</html>