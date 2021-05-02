<!-- form validation from: https://www.w3schools.com/php/php_form_validation.asp
	form syntax and functionality: https://github.com/alexasummers/CS371Demos/blob/main/new_employee.php
	SQL script reference: https://github.com/alexasummers/CS371Demos/blob/main/add_employee.php
	form field requirement: https://www.w3schools.com/php/php_form_required.asp
-->

<?php

	session_start();

	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === FALSE) {
		header("location: home.html");
		exit;
	}

	require_once 'connection.php';

	$AdvTitleErr = $AdvPriceErr = $AdvDetailsErr = $AdvCatErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// make sure no fields are empty
		if (empty($_POST["AdvTitle"])) { $AdvTitleErr = "Title is required"; } 

		if (empty($_POST["AdvPrice"])) { $AdvPriceErr = "Price is required; enter '0' if free"; }
		elseif (!is_numeric($_POST["AdvPrice"])) { $AdvPriceErr = "Price must be numeric; enter '0' if free"; }
		elseif ($_POST["AdvPrice"] > 100000) { $AdvPriceErr = "Price must be less than $100k"; }

		if (empty($_POST["AdvDetails"])) { $AdvDetailsErr = "Details are required"; } 

		if (empty($_POST["Category_ID"])) { $AdvCatErr = "You must choose a category"; } 

		// make sure errors are cleared before contacting database
		if (empty($AdvTitleErr) && empty($AdvPriceErr) && empty($AdvDetailsErr) && empty($AdvCatErr)) {
			$AdvTitle=isset($_POST['AdvTitle'])?$_POST['AdvTitle']:"";
			$AdvDetails=isset($_POST['AdvDetails'])?$_POST['AdvDetails']:"";
			$AdvDate=date("Y-m-d");
			$AdvPrice=isset($_POST['AdvPrice'])?$_POST['AdvPrice']:"";
			$User_ID=isset($POST[$_SESSION["User_ID"]])?$POST[$_SESSION["User_ID"]]:"";
			// mod ID added when it is reviewed by logged in moderator
			$Category_ID=isset($_POST['Category_ID'])?$_POST['Category_ID']:"";
			$Status_ID='PN';
			$SQL = "INSERT INTO Advertisements(AdvTitle, AdvDetails, AdvDate, AdvPrice, User_ID, Category_ID, Status_ID) VALUES (";
			$SQL.= "'".$AdvTitle."', '".$AdvDetails."', '".$AdvDate."', '".$AdvPrice."', '".$User_ID."', '".$Category_ID."', '".$Status_ID."')";
			$result = mysqli_query($connection, $SQL);

			if (!$result) { 
				die ("Unable to connect: " . mysqli_error($connection)); 
				sleep(5);
				header("location: login_home.php");
				exit;
			}
			else { header("Location: success.php"); }
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Ad Submission</title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="home.css">
	<style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
	<div class="navigationBar">
		<a href="login_home.php">Home</a>
		<a href="view_ads.php">View Public Ads</a>
		<a href="new_advertisement.php">Create Ad</a>
		<a href="logout.php">Logout</a>
	</div>	
    <div class="wrapper">
        <h2>Ad Submission</h2>
        <p>Enter the details for your ad below.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Ad Title: </label>
                <input type="text" maxlength="30" name="AdvTitle" class="form-control <?php echo (!empty($AdvTitleErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $AdvTitleErr; ?>">
                <span class="invalid-feedback"><?php echo $AdvTitleErr; ?></span>
            </div>    
            <div class="form-group">
                <label>Price: $</label>
                <input type="number" min="0" max="100000" name="AdvPrice" class="form-control <?php echo (!empty($AdvPriceErr)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $AdvPriceErr; ?></span>
            </div>
			<div class="form-group">
                <label>Category: </label>
					<select name="Category_ID">
					<option value=""></option>
					<option value="CAT">Cars and Trucks</option>
					<option value="ELC">Electronics</option>
					<option value="HOU">Housing</option>
					<option value="CCA">Child Care</option>
				</select>
                <span class="invalid-feedback"><?php echo $AdvCatErr; ?></span>
            </div>
			<div class="form-group">
                <label>Details: </label>
                <textarea maxlength="255" rows="5" cols="50" name="AdvDetails" class="form-control <?php echo (!empty($AdvDetailsErr)) ? 'is-invalid' : ''; ?>"></textarea>
                <span class="invalid-feedback"><?php echo $AdvDetailsErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
