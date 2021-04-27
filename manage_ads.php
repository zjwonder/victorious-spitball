<!-- For changing ad status or deleting ads -->

<?php
	session_start();
	
	// Check if the user has mod powers. If no, then redirect them to login home
	if (!(isset($_SESSION["user_is_mod"]) && $_SESSION["user_is_mod"] === TRUE)) { 
		header("location: login_home.php"); 
		exit;
	}

    require_once 'connection.php';

    // Querying the table
    $sql_of_q1 = "SELECT * FROM Advertisements";
    $q1result = mysqli_query($connection, $sql_of_q1);
?>

<html>
	<head>
		<title>Manage Ads</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>	
	<body>
		<div class="navigationBar">
			<a href="mod_home.php">Home</a>
			<a href="view_ads.php">View Public Ads</a>
			<a href="new_advertisement.php">Create Ad</a>
			<a href="manage_users.php">Manage Users</a>
			<a href="manage_ads.php">Manage Ads</a>
			<a href="logout.php">Logout</a>
		</div>
		<div style = "padding-left: 16px">
			<h2>Welcome to your moderator homepage!</h2>
			<h4>Use the navigation bar above to access various pages.</h4>
			<h4><u>Home</u> will take you... Home!</h4>
			<h4><u>Create Ad</u> will take you to a login page so that you can create an ad!</h4>
			<h4><u>View Ads</u> will take you to a page listing all ads! !WORK IN PROGRESS!</h4>
		<div style="margin-right: 100px">
		<table border="1">
			<?php
				echo "<tr>";
				echo "<td>".'Advertisement_ID'."</td>";
				echo "<td>".'AdvTitle'."</td>";
				echo "<td>".'AdvDetails'."</td>";
				echo "<td>".'AdvDate'."</td>";
				echo "<td>".'AdvPrice'."</td>";
				echo "<td>".'Category_ID'."</td>";
				echo "<td>".'User_ID'."</td>";
				echo "<td>".'Moderator_ID'."</td>";
				echo "<td>".'Status_ID'."</td>";
                echo "<td>".'Options'."</td>";
				echo "</tr>";
		
				while($r = mysqli_fetch_assoc($q1result)) {
					//fetches a result row as an associative array.
					echo "<tr>";
					echo "<td>".$r['Advertisement_ID']."</td>";
					echo "<td>".$r['AdvTitle']."</td>";
					echo "<td>".$r['AdvDetails']."</td>";
					echo "<td>".$r['AdvDate']."</td>";
					echo "<td>".$r['AdvPrice']."</td>";
					echo "<td>".$r['Category_ID']."</td>";
					echo "<td>".$r['User_ID']."</td>";
					echo "<td>".$r['Moderator_ID']."</td>";
					echo "<td>".$r['Status_ID']."</td>";
                    echo "<td>
                        <input type="submit" class="btn btn-primary" value="Login">
                        </td>";
					echo "</tr>";
				}
			?>
		</table>
		</div>
	</body>
</html>