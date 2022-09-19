<!DOCTYPE html>
<html>
	<head>
		<title>Register Page</title>
		<meta charset = "utf-8">
	</head>
	
	<body>
		<form method = "POST" action ="register.php" class = "form">
			<input type = "text" id = "username" name = "username" placeholder = "username"/>
			<input type = "email" id = "email" name = "email" placeholder = "email"/>
			<input type = "tel" id = "contactNumber" name = "contactNumber" placeholder = "Contact Number" pattern = "[0-9]{3}-[0-9]{7,8}"/>
			<input type = "text" id = "address" name = "address" placeholder = "Address"/>
			<input type = "password" id = "password" name = "password" placeholder = "password"/>
			<input type = "password" id = "confirmPassword" name = "confirmPassword" placeholder = "Confirm Password">
			
			<button type = "button" id = "userRegister" name = "userRegister" class = "registerButton">REGISTER</button>
		</form>
	</body>
	
	<script type="module">
	  // Import the functions you need from the SDKs you need
	  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
	  import { getDatabase, ref, set, child, get, update, remove } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-database.js";
	  // TODO: Add SDKs for Firebase products that you want to use
	  // https://firebase.google.com/docs/web/setup#available-libraries

	  // Your web app's Firebase configuration
	  const firebaseConfig = {
		apiKey: "AIzaSyDB10AZLKjKk76IA8-IUumeSpHI-1AgfQU",
		authDomain: "finalyearproject1-10f02.firebaseapp.com",
		databaseURL: "https://finalyearproject1-10f02-default-rtdb.firebaseio.com",
		projectId: "finalyearproject1-10f02",
		storageBucket: "finalyearproject1-10f02.appspot.com",
		messagingSenderId: "255992660850",
		appId: "1:255992660850:web:4b1c1e8c9539ab3b5913eb"
	  };

	  // Initialize Firebase
	  const app = initializeApp(firebaseConfig);
	  const database = getDatabase();
	  
	  //The reference
	  const email = document.getElementById('email').value;
	  const password = document.getElementById('password').value;
	  const username = document.getElementById('username').value;
	  const contactNumber = document.getElementById('contactNumber').value;
	  const confirmPassword = document.getElementById('confirmPassword').value;
	  const address = document.getElementById('address').value;
	  
	  //register form validation
	  function validation()
	  {
		  let regEmail = /[a-zA-Z0-9]+@(gmail|yahoo|outlook|hotmail)\.com/;
		  let regUsername = /[a-zA-Z0-9]{5,}/;
		  let regContactnumber = /[0-9]{3}-[0-9]{7,8}/;
	  }
	</script>
	
</html>