<?php include 'show_employees.php'; ?>

<html>
	<head>
		<title>Advertisements Manager Database</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>
	
	<body>
	
		<div class="navigationBar">
			<a href="home.html">Home</a>
			<a href="employeeInformation.php">Employees</a>
			<a href="home.html">Customers</a>
			<a href="home.html">Accounts</a>
			<a href="home.html">Transactions</a>
		</div>
		
		<div style="padding-left: 16px">
			<h2>Employee Information</h2>
			<?php echo $html; ?>
		</div>
	</body>
	
</html>