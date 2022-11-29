<!DOCTYPE html>
<html>
	<head>
		<title>Customer Feedback</title>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		 <!-- CSS -->
		<link rel="stylesheet" href="css/themify-icon.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		
		<style>
			*
			{
				margin : 0;
				padding : 0;
				box-sizing : border-box;
			}

			/*put the h1 in center , ajust the letter spacing , font size , and put the color*/
			h1
			{
				letter-spacing : 3px;
				text-align : center;
				font-size  : 65px;
				color      : #21618C;
				margin-top : 40px;
			}

			/*ajust the container width , padding , margin and other*/
			.container
			{
				position : relative;
				width : 1200px;
				background-color : white;
				padding : 20px 30px;
				margin: 2% auto 0;
				margin-bottom: 50px;
				border-radius : 15px;
				display : flex;
				align-items : center;
				justify-content : center;
				flex-direction : column;
				border:2px solid #E9ECEF;
				box-shadow: 18px 18px 8px #D6DBDF;
			}

			.container .post
			{
				display : none;
			}

			.container .text
			{
				font-size : 50px;
				color : 21618C;
				font-weight : 500;
			}

			.container .edit
			{
				position : absolute;/*ajust the edit position*/
				right : 10px;
				top : 5px;
				font-size : 16px; /*ajust the font size*/
				color : #2471A3; /*put the font color for edit */
				font-weight : 500;
				cursor : pointer;
			}

			.container .edit:hover
			{
				text-decoration : underline;
			}

			.container .star input[type=radio]
			{
				display : none;
			}

			.star label
			{
				font-size : 85px; /*ajust the star size */
				color : #444444;
				padding : 65px;
				float : right;
				transition : all 0.2s ease;
			}

			input:not(:checked)~label:hover , 
			input:not(:checked)~label:hover ~label
			{
				color : #FFDD44;
			}

			input:checked~label
			{
				color : #FFDD44;
			}

			/*When the user press 5 star , the star of color will be difference and have the text shadow*/
			input#feedback-5:checked~label
			{
				color : #FFEE77;
				text-shadow : 0 0 20px #995522;
			}

			/*Display the content for each of the star*/
			#feedback-1:checked ~ form .content:before
			{
				content : "I just hate it😣";
			}

			#feedback-2:checked ~ form .content:before
			{
				content : "I don't like it😥";
			}

			#feedback-3:checked ~ form .content:before
			{
				content : "It is awesome😃";
			}

			#feedback-4:checked ~ form .content:before
			{
				content : "I just like it😎";
			}

			#feedback-5:checked ~ form .content:before
			{
				content : "I just love it😍";
			}


			/*For the content width , font size , font color , margin and other*/
			form .content
			{
				width : 100%;
				font-size: 45px;
				color : #21618C;
				font-weight : 500;
				margin : 5px 0 20px 0;
				text-align : center;
				transition : all 0.2s ease;
			}

			form input[type=text], input[type=email], input[type=tel],select
			{
				width:100%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
				align-items:center;
			}

			/*Ajust for the textarea column height , width and overflow*/
			form .textarea
			{
				height : 100px;
				width : 100%;
				overflow : hidden;
			}

			/*Ajust for the textarea  height , width outline , font color and other*/
			form .textarea textarea
			{
				height : 100%;
				width : 100%;
				padding : 10px;
				font-size : 17px;
			}

			form .btn
			{
				height : 55px;
				width : 100%;
				margin : 15px 0;
			}

			/*Ajust for the post button height , width , border , outline and other*/
			form .btn input[type=submit]
			{
				display:inline-block;
				text-transform:uppercase;
				height : 100%;
				width : 100%;
				border:none;
				background : #2874A6;
				color : #FFFFFF;
				border-radius:8px;
				font-size : 25px;
				font-weight : 600;
				cursor : pointer;
				transition : all 0.3s ease;
			}

			form .btn input[type=submit]:hover
			{
				background : #5499C7;
			}
		</style>
	</head>
	
	<body>
		<?php
			include("courier_management_system.php");
			
			include('homepage_header.php');
			
			if(isset($_POST['submitted']))
			{
				$feedback = $_POST['feedback'];
				$courierID = $_POST['courierID'];
				$fullName = $_POST['fullName'];
				$email = $_POST['email'];
				$contactNumber = $_POST['contactNumber'];
				$description = $_POST['description'];
				
				$query=mysqli_query($combine,"insert into feedback(fullName,email,contactNumber,courierID,feedback,description) 
				value('$fullName',' $email','$contactNumber','$courierID',' $feedback','$description')");
				if ($query) 
				{
					//$msg="Remark and Status has been updated.";
					 echo '<script>alert("Thank you for your rating.")</script>';
					 echo "<script>window.location.href ='feedback.php'</script>";
			    }
			    else
				{
				   echo '<script>alert("Something Went Wrong. Please try again")</script>';
				}
			}
		?>
		
		<h1>FEEDBACK</h1>
		
		<div class = "container">
			
			<!--After the user feedback finish , will print out the text and user can edit their feedback-->
			<div class = "post">
				<div class = "text">Thanks for rating us ！</div>
				<div class = "edit">EDIT</div>
			</div><!--End post div-->
		
				
			<!--Create a form for user to enter their experience-->
			<form method = "post" name = "feedback" action="feedback.php">
			
				<div class = "star">
					<!--User radio type to do the star feedback-->
					<input type = "radio" name = "feedback" id = "feedback-5" value = "5 star">
					<label for = "feedback-5" class="fa fa-star"></label>
					<input type = "radio" name = "feedback" id = "feedback-4" value = "4 star">
					<label for = "feedback-4" class="fa fa-star"></label>
					<input type = "radio" name = "feedback" id = "feedback-3" value = "3 star">
					<label for = "feedback-3" class="fa fa-star"></label>
					<input type = "radio" name = "feedback" id = "feedback-2" value = "2 star">
					<label for = "feedback-2" class="fa fa-star"></label>
					<input type = "radio" name = "feedback" id = "feedback-1" value = "1 star">
					<label for = "feedback-1" class="fa fa-star"></label>
				</div>
				
				<!--According to the number of stars selected by the user, the displayed text and emoji are different.-->
				<div class = "content"></div>
				
				<p>Full Name</p>
				<input type = "text" id = "fullName" name = "fullName" placeholder = "Full Name" value= "<?php if(isset($_POST["fullName"])) echo $_POST["fullName"]; ?>"/><br><br>
				
				<p>Email</p>
				<input type = "email" id = "email" name = "email" placeholder = "Email" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>"><br><br>
				
				<p>Contact Number</p>
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}" value= "<?php if(isset($_POST["contactNumber"])) echo $_POST["contactNumber"]; ?>"/><br><br>
				
				<p>Select Courier Company</p>
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
				
				
				<!--Create a textarea for user to enter their experience-->
				<div class = "textarea">
					<textarea cols = "30" rows = "10" placeholder = "Describe your experience......" id = "description" name = "description"
					value= "<?php if(isset($_POST["description"])) echo $_POST["description"]; ?>"></textarea>
				</div><!--End textarea div-->
				
				<br/>
				
				<!--After user have complete the feedback , can press the button of post to submit-->
				<div class = "btn">
					<input type = "hidden" name = "submitted" value = "true"/>
					<input type = "submit" value = "POST" name = "submit"/> 
				</div><!--End btn div-->
			
			</form>
			
		</div><!--End container div-->
		
		<!--Javascript-->
		<script>
			const btn = document.querySelector("button");
			const post = document.querySelector(".post");
			const star = document.querySelector(".star");
			const editBtn = document.querySelector(".edit");
			
			btn.onclick = ()=>{
				star.style.display = "none";
				post.style.display = "block";
				editBtn.onclick = ()=>{
					star.style.display = "block";
					post.style.display = "none";
				}
				return false;
			}
			
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
		
		<?php
			include('footer.php');
		?>
	</body>
	
</html>