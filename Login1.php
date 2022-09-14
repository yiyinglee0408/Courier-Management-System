<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
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
				height:585px;
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
				margin:50px;
			}
			
			input[type=text], input[type=password],  input[type=email]
			{
				width:70%;
				border:none;
				border-bottom:2px solid black;
				padding:12px 20px;
				margin: 8px 0;
				box-sizing:border-box;
			}
			
			.loginButton
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
			
			.loginButton:hover
			{
				background-color:#5499C7;
			}
			
			.image
			{
				display:flex;
				justify-content:center;
				align-items:center;
			}
			
			.account
			{
				margin-bottom:20px;
			}
		</style>
		
		<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
	</head>
	
	<body>
		
		<div class = "container">
		
			<form method = "POST" action ="Login1.php" class = "form">
			
				<h1 style="text-transform:uppercase">Login</h1>
				
				<p class = "account"><small>Don't have an account? <a href = "user_register.php" style="color:#2874A6"><strong>Register</strong></a></small></p>
		
				<input type = "email" id = "email" name = "email" placeholder = "Email"><br>
				
				<input type = "password" id = "password" name = "password" placeholder = "Password">
				
				<p style="margin-bottom:20px"><a href = "forgetPassword.php" style="color:#2874A6"><small><strong>Forget Password?</strong></small></a></p>
				
				<button type = "button" id = "userLogin" name = "userLogin" class = "loginButton">Login</button>
				
			</form>
			
			<div class = "image">
				<img src = "image/login3.jpg" alt = "User Login">
			</div>	
		</div>
	</body>
	
	<script type="module">
	  // Import the functions you need from the SDKs you need
	  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-app.js";
	  import { getDatabase, set, ref, update } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-database.js";
	  import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword,  onAuthStateChanged } from "https://www.gstatic.com/firebasejs/9.9.4/firebase-auth.js";
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
	  const user = auth.currentUser;
	  
	   userLogin.addEventListener('click',(e)=> {
		   var email = document.getElementById('email').value;
		   var password = document.getElementById('password').value;
		   
		   //Login form validation
		   var regEmail = /[a-zA-Z0-9]+@(gmail|yahoo|outlook)\.com/;
		   
		   if(email == "" || password == "")
		   {
			   alert("Please do no let the field empty");
			   return false;
		   }
		   
		   if(!regEmail.test(email))
		   {
			   alert("Please enter a valid email");
			   return false;
		   }
		   
		   signInWithEmailAndPassword(auth, email, password)
		  .then((userCredential) => {
			// Signed in 
			const user = userCredential.user;
			
			const date = new Date();
			update(ref(database, 'Users/' + user.uid),{
				lastLogin : date,
			})
			
			alert("You have been login succesfully");
			// ...	
		  })
		  .catch((error) => {
			const errorCode = error.code;
			const errorMessage = error.message;
			
			alert(errorMessage);
		  });
	   });
	   
	   onAuthStateChanged(auth, (user) => {
		  if (user) {
			// User is signed in, see docs for a list of available properties
			// https://firebase.google.com/docs/reference/js/firebase.User
			const uid = user.uid;
			// ...
		  } else {
			// User is signed out
			// ...
		  }
		});
	</script>
</html>