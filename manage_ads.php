<!-- For changing ad status or deleting ads -->

<?php
	session_start();
	
	// Check if the user has mod powers. If no, then redirect them to login home
	// if (!(isset($_SESSION["user_is_mod"]) && $_SESSION["user_is_mod"] === TRUE)) { 
	// 	header("location: login_home.php"); 
	// 	exit;
	// }

    require_once 'connection.php';

    // Querying the table
    $sql_of_q1 = "SELECT * FROM Advertisements";
    $q1result = mysqli_query($connection, $sql_of_q1);
	$input_status = $input_ad_id = "";
	$feedback = "";
    
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["input_status"])) {
		
		$input_status = $_POST["input_status"];
		$input_ad_id = $_POST["input_ad_id"];
		$mod_id = $_SESSION["User_ID"];
		
		// Prepare a select statement to search from USERS table
		$sql = "UPDATE Advertisements SET Status_ID='$input_status', Moderator_ID='$mod_id' WHERE Advertisement_ID='$input_ad_id'";
		
		if ($connection->query($sql) === TRUE) {
			$feedback = "Update applied to ad ".$input_ad_id;
		}
		else {
			$feedback = "Update failed: ".$connection->error;
		}
		
		// Close connection
		mySQLi_close($connection);
	}
        
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
			<a href="manage_ads.php">Manage Ads</a>
			<a href="logout.php">Logout</a>
		</div>
		<div style = "padding-left: 16px">
			<h2>Manage Ads</h2>
			<h4>Use the drop down menus to change ad status.</h4>
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
                echo "<td></td>";
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
                    echo ("<td>
							<form method=\"post\">
								<select name=\"input_status\" id=\"input_status\">
									<option value=\"\"></option>
									<option value=\"DI\">Disapproved</option>
									<option value=\"PN\">Pending</option>
									<option value=\"AC\">Active</option>
								</select>	
								<input type = \"hidden\" name=\"input_ad_id\" value=\"".$r['Advertisement_ID']."\" />
								<input type=\"submit\" class=\"btn btn-primary\" value=\"Update\" />
							</form>
                        </td>"
					);
					echo "</tr>";
				}
				echo $feedback;
			?>
		</table>
		</div>
	</body>
</html>
