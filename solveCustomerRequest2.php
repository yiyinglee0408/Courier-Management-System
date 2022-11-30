<!DOCTYPE html>
<html>
	<head>
		<title>User Delivery Details Page</title>
		<meta charset = "utf-8">
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
	
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	
	$ID = $_GET['ID'];
	$courierAction = $_GET['courierAction'];
	
	$sql = "SELECT * FROM customerservice WHERE ID = '$ID'";
	$result = mysqli_query($combine, $sql);
	$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	$q1 = "UPDATE customerservice SET courierAction='$courierAction' WHERE customerservice.ID = '$ID'";
	
	if($combine->query($q1)===TRUE)
	{
		try 
		{
			$mail->isSMTP();  //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';  //Set the SMTP server to send through
			$mail->SMTPAuth   = true; //Enable SMTP authentication
			$mail->Username   = 'yiying13298@gmail.com'; //SMTP username
			$mail->Password   = 'cpcjlktailpbawpt';  //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Enable implicit TLS encryption
			$mail->Port       = 465;   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('from@example.com', 'Courier Customer Service');
			$mail->addAddress('lyy395989@gmail.com');  //Add a recipient
			
			//Email notification content
			$message="Courier Customer Service : ".$courierAction;
			
			//Content
			$mail->isHTML(true); //Set email format to HTML
			$mail->Subject = 'Courier Customer Service';
			$mail->Body    = $message;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			//echo 'Message has been sent';
		}
		catch (Exception $e) 
		{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		echo"<script>alert('Reply successfully!');
		window.location='viewCustomerRequest.php'</script>";
	}
                
	else
	{
		echo "<script>alert('Reply Failed!');
		window.location='viewCustomerRequest.php'</script>";	
	}	
?>