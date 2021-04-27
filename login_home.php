<!-- Homepage for logged in users -->

<?php
    session_start();
	
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === FALSE) {
        header("location: home.html");
        exit;
    }
	elseif ($_SESSION['user_is_mod']) { 
		header("location: mod_home.php");
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
			<a href="view_ads.php">View Public Ads</a>
			<a href="new_advertisement.php">Create Ad</a>
			<a href="logout.php">Logout</a>
		</div>

    <img src="https://thumbs.gfycat.com/OffensiveOpulentGecko.webp" alt="Computer" width="200"
           height="100">

    <center>
		<div style = "padding-left: 16px">
			<h2>Welcome to <br> the <br> <u>Advertisements Manager</u>!</h2>
      <img src="https://thumbs.gfycat.com/AcidicHardtofindEmeraldtreeskink-max-1mb.gif" alt = "Man" width="150"
      height="150">

			<h4>Use the navigation bar above to access various pages.</h4>
			<h4><a href="login_home.php"><b>Home</b></a> will take you... Home!</h4>
			<h4><a href="new_advertisement.php"><b>Create Ad</b></a> will take you to a login page so that you can create an ad!</h4>
			<h4><a href="view_ads.php"><b>View Ads</b></a> will take you to a page listing all ads!</h4>
    </center>



	</body>
</html>