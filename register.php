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
	  import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-auth.js";
	  // TODO: Add SDKs for Firebase products that you want to use
	  // https://firebase.google.com/docs/web/setup#available-libraries

	  // Your web app's Firebase configuration
	  const firebaseConfig = {
		apiKey: "AIzaSyC2AtPu3GqZ018lEJbYasSD4BvO4vgH4eg",
		authDomain: "finalyearproject-4ec13.firebaseapp.com",
		databaseURL: "https://finalyearproject-4ec13-default-rtdb.firebaseio.com",
		projectId: "finalyearproject-4ec13",
		storageBucket: "finalyearproject-4ec13.appspot.com",
		messagingSenderId: "9820325856",
		appId: "1:9820325856:web:a30ecd70758821c3200d85"
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
		
		  createUserWithEmailAndPassword(auth, email, password)
		  .then((userCredential) => {
			// Signed in 
			const user = userCredential.user;
			alert('You have been register successfully!');
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