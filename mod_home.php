<?php
    if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE)) {
        echo "you're not logged in? sesh probs"
		// header("location: home.html");
        // exit;
    }
    elseif (!$_SESSION["user_is_mod"]) { 
        echo "shit's broke";
		// header("location: login_home.php"); 
        // exit;
    }
?>

<html>
	<head>
		<title>Mod Login Home</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>	
	<body>
		<div class="navigationBar">
			<a href="mod_home.php">Home</a>
			<a href="active_ads.php">View Public Ads</a>
			<a href="new_advertisement.php">Create Ad</a>
			<a href="manage_users.php">Manage Users</a>
			<a href="manage_ads.php">Manage Ads</a>
			<a href="logout.php">Logout</a>
		</div>
		<div style = "padding-left: 16px">
			<h2>Welcome to the Advertisements Manager Database!</h2>
			<h4>Use the navigation bar above to access various pages.</h4>
			<h4><u>Home</u> will take you... Home!</h4>
			<h4><u>Create Ad</u> will take you to a login page so that you can create an ad!</h4>
			<h4><u>View Ads</u> will take you to a page listing all ads! !WORK IN PROGRESS!</h4>
	</body>
</html>