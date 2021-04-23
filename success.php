<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === FALSE) {
	header("location: home.html");
	exit;
}

sleep(5);
header("location: login_home.php");
exit;

?>

<html>
	<head>
		<title>Advertisements Manager Database</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>
	
	<body>
		
		<div style = "padding-left: 16px">
			<h2>Success!</h2>
            <h3>Your ad has been submitted and is pending mod approval.</h3>
			<h4>Redirecting you momentarily...</h4>
			
	</body>
	
</html>