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

		<div class="navigationBar">
			<a href="home.html">Home</a>
			<a href="view_ads.php">View Ads</a>
			<a href="login.php">Login</a>
			<a href="register.php">Register</a>
		</div>

		<img src="https://thumbs.gfycat.com/OffensiveOpulentGecko.webp" alt="Computer" width="200"
           height="100">
    <center>
	  <div class="centerThings">
			<h2>Success!</h2>
            <h3>Your ad has been submitted and is pending mod approval.</h3>
			<h4>Redirecting you momentarily or <a href="home.html">click here</a> to go home </h4>
		</div>
    </center>
      <center>
			<img src="https://images.unsplash.com/photo-1534180003648-8f8d6c814cdb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8N3x8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=60" alt="umbrella" width="500"
	           height="400">
      </center>
	</body>

</html>