<!DOCTYPE html>
<html>
	<head>
	
		<title>User Shipment Details</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
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
				height:470px;
				width:1350px;
				margin:auto;
				margin-top: 75px;
				margin-bottom:50px;
				border-style: solid;
				border-color: #E9ECEF;
			}
			
			.form
			{
				background-color:white;
				padding-left:50px;
				padding-top:30px;
				padding-bottom:33px;
			}
			
			input[type=text],input[type=number], input[type=date]
			{
				width:95%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			.calculateWeight
			{
				background-color: white;
				border: none;
				color: black;
				padding: 12px 0px;
				font-size: 20px;
				cursor: pointer;
			}
			
			.calculateModal
			{
				  display: none; /* Hidden by default */
				  position: fixed; /* Stay in place */
				  z-index: 1; /* Sit on top */
				  padding-top: 100px; /* Location of the box */
				  left: 0;
				  top: 0;
				  width: 100%; /* Full width */
				  height: 100%; /* Full height */
				  overflow: auto; /* Enable scroll if needed */
				  background-color: rgb(0,0,0); /* Fallback color */
				  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}
			
			.calculateModalContent
			{
				background-color: #fefefe;
			    margin: auto;
			    padding: 20px;
			    border: 1px solid #888;
			    width: 80%;
			}
			
			/* The Close Button */
			.close {
			  color: #aaaaaa;
			  float: right;
			  font-size: 28px;
			  font-weight: bold;
			}

			.close:hover,
			.close:focus {
			  color: #000;
			  text-decoration: none;
			  cursor: pointer;
			}
						
		</style>
		
		<!--Boxicons CDN Link-->
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	</head>
	
	<body>
	
		<div class = "container">
		
			<form method = "POST" action = "shipmentDetails.php" class = "form">
			
				<h3 style = "color:#21618C">Shipment Details</h3><br/>
				
				<label for = "quantity">Parcel Weight(kg)</label><br/>
				<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg"><button id = "calculateWeight" name = "calculateWeight" class = "calculateWeight"><i class='bx bx-calculator'></i></button><br><br>
				
				<label for = "mode">Parcel Collection Date</label><br>
				<input type = "date" id = "collectionDate" name = "collectionDate"><br><br>
				
				<label for = "mode">Parcel Content</label><br>
				<input type = "text" id = "parcelContent" name = "parcelContent" placeholder = "Eg:Book"><br><br>
				
				<label for = "mode">Parcel Value(MYR)</label><br>
				<input type = "text" id = "parcelContent" name = "parcelContent" placeholder = "Eg:15.00"><br><br>
			
			</form>
		
		</div>
		
		<div class = "calculateModal" id = "calculateModal" name = "calculateModal">
		
			<div class = "calculateModalContent">
				<span class="close">&times;</span>
				<form method = "POST" action = "shipmentDetails.php">
					<label for = "quantity">Parcel Length(cm)</label><br/>
					<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg"><br><br>
					
					<label for = "quantity">Parcel Width(cm)</label><br/>
					<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg"><br><br>
					
					<label for = "quantity">Parcel Height(cm)</label><br/>
					<input type="text" id="parcelWeight" name="parcelWeight" placeholder = "Eg:1kg"><br><br>
				</form>
			
			</div>
		
		</div>
	
	</body>
	
	<script>
	
		//Get the Calculator Modal
		var calculateModal = document.getElementById("calculateModal");
		var calculateWeight = document.getElementById("calculateWeight");
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		
		calculateWeight.onclick = function() 
		{
		  calculateModal.style.display = "block";
		}
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  calculateModal.style.display = "none";
		}
	</script>

</html>