<!-- For changing or deleting existing users -->

<?php
	session_start();
	
	// Check if the user has mod powers. If no, then redirect them to login home
	if (!(isset($_SESSION["user_is_mod"]) && $_SESSION["user_is_mod"] === TRUE)) { 
		header("location: login_home.php"); 
		exit;
	}

    require_once "connection.php";

    // from here we should pull users from database and have an option to delete them
?>