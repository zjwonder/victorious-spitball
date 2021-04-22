<?php
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === FALSE) {
        header("location: home.html");
        exit;
    }
?>

<html>
	<head>
		<title>Ad Manager Home</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>	
	<body>
		<div class="navigationBar">
			<a href="login_home.php">Home</a>
			<a href="active_ads.php">View Public Ads</a>
			<a href="new_advertisement.php">Create Ad</a>
			<a href="logout.php">Logout</a>
		</div>	
		<div style = "padding-left: 16px">
			<h2>Welcome to the Advertisements Manager!</h2>
			<h4>Use the navigation bar above to access various pages.</h4>
			<h4><u>Home</u> will take you... Home!</h4>
			<h4><u>Create Ad</u> will take you to a login page so that you can create an ad!</h4>
			<h4><u>View Ads</u> will take you to a page listing all ads! !WORK IN PROGRESS!</h4>
	</body>
</html>