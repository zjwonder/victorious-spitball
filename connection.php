<?php

	$db_hostname = "localhost";
	$db_database = "cs371spring2021";
	$db_username = "root";
	$db_password = "";
	
	$connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
		// saves database connection to $connection
		
	if (!$connection)
		die("Unable to connect to MySQL: " . mysqli_error($connection));

?>