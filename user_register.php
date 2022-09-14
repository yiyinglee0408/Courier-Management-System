<!DOCTYPE html>
<html>
	<head>
		<title>Register Page</title>
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
				background:url("image/registerBackground.jpeg");
			}
			
			a
			{
				text-decoration: none;
			}
			
			a:hover
			{
				text-decoration: underline;
			}
			
			.container
			{
				display:flex;
				height:595px;
				width: 1100px;
				margin:auto;
				margin-top: 75px;
			}
			
			.form
			{
				display:flex;
				flex-direction:column;
				width: 50%;
				align-items:center;
				background-color:white;
			}
			
			.form h1
			{
				margin:26px;
			}
			
			input[type=text], input[type=password], input[type=email], input[type=tel]
			{
				width:70%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			.registerButton
			{
				display:inline-block;
				width:70%;
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
			
			.registerButton
			{
				display:inline-block;
				width:70%;
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
			
			.registerButton:hover
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
				height:595px;
			}
			
			media screen and (min-width:900px)
			{
				.container{
					flex-direction:row;
					height:100vh;
				}
				.image,
				{
					display:flex;
					width:50%;
					height:auto;
				}
			}
		</style>
		
		<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
		
	</head>
	
	<body>
		<div class = "container">
			
			<div class = "image">
				<img src = "image/register.jpg" alt = "User Register">
			</div>
			
			<form method = "POST" action ="user_register.php" class = "form">
			
				<h1 style="text-transform:uppercase">Register</h1>
				
				<p style="margin-bottom:5px"><small>Already have an account? <a href = "Login1.php" style="color:#2874A6"><strong>Log In</strong></a></small></p>
				
				<input type = "text" id = "username" name = "username" placeholder = "Username"/>
				
				<input type = "email" id = "email" name = "email" placeholder = "Email"/>
				
				<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}"/>
				
				<input type = "text" id = "address" name = "address" placeholder = "Address"/>
				
				<input type = "password" id = "password" name = "password" placeholder = "Password"/>
				
				<input type = "password" id = "confirmPassword" name = "confirmPassword" placeholder = "Confirm Password">
				
				<button type = "button" id = "userRegister" name = "userRegister" class = "registerButton">REGISTER</button>
				
				<p><small><center>By continuing, you agree to our<br><a href = "#" style="color:#2874A6">Terms and Conditions</a> and <a href = "#" style="color:#2874A6">Privacy Policy</a></center></small></p>
			</form>
		</div>
	</body>
	
	<script type="module">
	  // Import the functions you need from the SDKs you need
	  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-app.js";
	  import { getDatabase, set, ref } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-database.js";
	  import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-auth.js";
	  // TODO: Add SDKs for Firebase products that you want to use
	  // https://firebase.google.com/docs/web/setup#available-libraries

	  // Your web app's Firebase configuration
	  const firebaseConfig = {
		apiKey: "AIzaSyDfQER_85Q0RIXqr-OFg2VFqVTQxCKBVNY",
		authDomain: "courier-management-syste-28db5.firebaseapp.com",
		projectId: "courier-management-syste-28db5",
		storageBucket: "courier-management-syste-28db5.appspot.com",
		messagingSenderId: "36351898608",
		appId: "1:36351898608:web:b859d94e2644bd388da335"
	  };

	  // Initialize Firebase
	  const app = initializeApp(firebaseConfig);
	  const database = getDatabase(app);
	  const auth = getAuth();
	  
	   userRegister.addEventListener('click',(e)=> {
  
		var email = document.getElementById('email').value;
		var password = document.getElementById('password').value;
		var username = document.getElementById('username').value;
		var contactNumber = document.getElementById('contactNumber').value;
		var confirmPassword = document.getElementById('confirmPassword').value;
		var address = document.getElementById('address').value;
		
		//Register form validation
		var regEmail = /[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com/;
		var regUsername = /[a-zA-Z0-9]{5,}/;
		var regContactnumber = /[0-9]{3}-[0-9]{7,8}/;
		
		if(email == "" || password == "" || username == "" || contactNumber == "" || confirmPassword == "" || address == "")
		{
			alert("Please do no let the field empty");
			return false;
		}
		
		if(!regEmail.test(email))
		{
			alert("Please enter a valid email");
			return false;
		}
		
		if(password.length < 6)
		{
			alert("Password must be at least 6 character");
			return false;
		}
		
		if(confirmPassword != password)
		{
			alert("Confirm password does not same with password, please enter again");
			return false;
		}
		
	    if(!regUsername.test(username))
		{
			alert("-Username can only be alphanumeric\n-username must be atleast 5 characters\n-username cannot contain spaces");
			return false;
		}
		
		if(!regContactnumber.test(contactNumber))
		{
			alert("Please enter valid contact number");
			return false;
		}
		
		createUserWithEmailAndPassword(auth, email, password)
		  .then((userCredential) => {
			// Signed in 
			const user = userCredential.user;
			
			set(ref(database, 'Users/' + user.uid),{
				username : username,
				email : email,
				contactNumber : contactNumber,
				address : address
			})
			
			alert('You have been register successfully!');
			window.location='Login1.php';
			// ...
		  })
		  .catch((error) => {
			const errorCode = error.code;
			const errorMessage = error.message;
			
			alert(errorMessage);
			// ..
		  });
	  });
	</script>
	
</html>