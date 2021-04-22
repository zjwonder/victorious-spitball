<?php
	
	require_once('connection.php');
		// must include connection file
	
	$connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		// saves database connection to $connection
		
	if (!$connection)
		die("Unable to connect to MySQL: " . mysqli_error($connection));
	
	$query = "SELECT * FROM Employees";
	$result = mysqli_query($connection, $query);
			// saves db records to $result
	
	if (!$result)
		die("Database query failed: " . mysqli_error($connection));
		
	$html = "";
		// empty string to store everything
	
	while ($row = mysqli_fetch_assoc($result)) {
		// iterates through result set database rows
		
		$html.="Employee ID: " . $row['Employee_id'] . "<br>";
		$html.="Name: " . $row['EmpFirst_Name'] . " " . $row['EmpLast_Name'] . "<br>";
		$html.="Start Date: " . $row['EmpStart_date'] . "<br>";
		$html.="End Date: " . $row['EmpEnd_date'] . "<br>";
		$html.="Supervisor ID : " . $row['EmpSupervisor_ID'] . "<br>";
		$html.="Department ID : " . $row['Department_ID'] . "<br>";
		$html.="Branch ID : " . $row['Branch_ID'] . "<br>";
		$html.="<br><br>";
		// updates $html string with fields from database
	}
	
	mysqli_close($connection);
		// closes database connection
?>