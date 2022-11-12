<!DOCTYPE html>
<html>
	<head>
		<title>Courier DashBoard</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
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
			
		</style>
		
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
			
			$sql = "SELECT date as d, SUM(totalPrice) as tp FROM payment WHERE payment.courierID='$courierID' GROUP BY date ORDER BY date";
			$result = mysqli_query($combine, $sql);
			$chart_data="";
			while($row = mysqli_fetch_assoc($result))
			{
				$totalPrice[]  = $row['tp']  ;
				$date[] = $row['d'];
			}
		?>
	
	<body>
	
		<h1 style = "color:#21618C; margin-left:330px; padding-top:30px;">Dashboard</h1><br/>
		
		 <div style="width:50%;hieght:20%;text-align:center; margin-left:330px;">
			<h2 class="page-header" >Statistic Analysis</h2>
			<div>Courier Revenue</div>
			<canvas  id="chartjs_bar"></canvas> 
		 </div><br><br>

		<?php
			$sql1 = "SELECT expenses as e, SUM(price) as p FROM courierexpenses WHERE courierexpenses.courierID='$courierID' GROUP BY expenses ORDER BY expenses";
			$result1 = mysqli_query($combine, $sql1);
			$chart_data1="";
			while($row1 = mysqli_fetch_assoc($result1))
			{
				$price[]  = $row1['p']  ;
				$expenses[] = $row1['e'];
			 }
		?>
		
		<div style="width:50%;hieght:20%;text-align:center; margin-left:330px;">
            <h2 class="page-header" >Statistic Analysis</h2>
            <div>Courier Expenses</div>
            <canvas  id="chartjs_bar1"></canvas> 
        </div>    
		
		<?php
			$sql = "SELECT * FROM user_delivery_details WHERE courierID = '$courierID'";
			$result = mysqli_query($combine, $sql);
			$totalDelivery = mysqli_num_rows($result);
		?>
		
		<h2 style = "color:#21618C; margin-left:330px; padding-top:30px;">Total Parcel<?php echo $totalDelivery;?></h2></a>
	
	</body>
	
	<script type="text/javascript">
		  var ctx = document.getElementById("chartjs_bar").getContext('2d');
					var myChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels:<?php echo json_encode($date); ?>,
							datasets: [{
								backgroundColor: [
								   "#5969ff",
									"#ff407b",
									"#25d5f2",
									"#ffc750",
									"#2ec551",
									"#7040fa",
									"#ff004e"
								],
								data:<?php echo json_encode($totalPrice); ?>,
							}]
						},
						options: {
							   legend: {
							display: true,
							position: 'bottom',
	 
							labels: {
								fontColor: '#71748d',
								fontFamily: 'Circular Std Book',
								fontSize: 14,
							}
						},
	 
	 
					}
					});
			
			 var ctx1 = document.getElementById("chartjs_bar1").getContext('2d');
					var myChart = new Chart(ctx1, {
						type: 'bar',
						data: {
							labels:<?php echo json_encode($expenses); ?>,
							datasets: [{
								backgroundColor: [
								   "#5969ff",
									"#ff407b",
									"#25d5f2",
									"#ffc750",
									"#2ec551",
									"#7040fa",
									"#ff004e"
								],
								data:<?php echo json_encode($price); ?>,
							}]
						},
						options: {
							   legend: {
							display: true,
							position: 'bottom',
	 
							labels: {
								fontColor: '#71748d',
								fontFamily: 'Circular Std Book',
								fontSize: 14,
							}
						},
	 
	 
					}
					});
	</script>
	
</html>