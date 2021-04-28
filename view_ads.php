<?php
    session_start();
	
	if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE)) {
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
		<title>View Ads</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>
	<body>
		<div class="navigationBar">
			<a href="home.html">Home</a>
			<a href="view_ads.php">View Ads</a>
			<a href="login.php">Login</a>
			<a href="register.php">Register</a>
		</div>	
		<div style = "padding-left: 16px">
		<?php
			require_once 'connection.php';

			// Querying the table
			$sql_of_q1 = "SELECT * FROM Advertisements WHERE Status_ID='AC'";
			$q1result = mysqli_query($connection, $sql_of_q1);
		?>
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
					echo "</tr>";
				}
			?>
		</table>
		</div>
	</body>
</html>