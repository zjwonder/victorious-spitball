<?php

	$db_hostname = "localhost";
	$db_database = "noProject2";
	$db_username = "root";
	$db_password = "";
	
	$connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		// saves database connection to $connection
		
	if (!$connection)
		die("Connection error: " . mysqli_error($connection));

?>