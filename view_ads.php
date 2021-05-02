<?php
    session_start();
	
	// if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE)) {
    //     header("location: home.html");
    //     exit;
    // }
	// elseif ($_SESSION['user_is_mod']) { 
	// 	header("location: mod_home.php");
	// 	exit;
	// }
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
		
		<img src="https://thumbs.gfycat.com/OffensiveOpulentGecko.webp" alt="Computer" width="200"
           height="100">
		   
		<center>
		<h2>
		Welcome to <br>
		VIEW ADS
		</h2>
		Please view various ads below!
		<br>  
		
		<img src="https://thumbs.gfycat.com/BoringNeighboringDegu.webp" alt = "Tree" width="250"
    height="250">	
	
		</center>
		
		<div style = "padding-left: 110px">
		<?php
			require_once 'connection.php';

			// Querying the table
			$sql_of_q1 = "SELECT * FROM Advertisements WHERE Status_ID='AC'";
			$q1result = mysqli_query($connection, $sql_of_q1);
		?>
		<div style="margin-right: 100px">
		<table border="3">
		
		<caption><b><u>ADS</u></b></caption>
		
			<?php
				echo "<tr>";
				echo "<td>".'ID'."</td>";
				echo "<td>".'Title'."</td>";
				echo "<td>".'Details'."</td>";
				echo "<td>".'Date'."</td>";
				echo "<td>".'Price'."</td>";
				echo "<td>".'Category'."</td>";
				echo "<td>".'User'."</td>";
				echo "<td>".'Moderator'."</td>";
				echo "<td>".'Status'."</td>";
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
