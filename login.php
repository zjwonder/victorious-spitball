<!-- Login code from: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php 
	 hash values from: https://www.onlinewebtoolkit.com/hash-generator -->

<?php
	// start user session
	session_start();
	// Check if the user is already logged in. If yes, then redirect them to new_advertisement.php
	// Check if the user is already logged in. If yes, then redirect them to new_advertisement.php
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE) {
		if ($_SESSION["user_is_mod"] == FALSE) { 
			header("location: login_home.php"); 
			exit;
		}
		else { 
			header("location: mod_home.php");
			exit; 
		}
	}
	 
	// Include config file
	require_once "connection.php";

	// Define variables and initialize with empty values
	$User_ID = "";
	$password = "";
	$User_ID_err = "";
	$password_err = "";

	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 
		// Check if User_ID is empty
		if (empty(trim($_POST["User_ID"]))) {
			$User_ID_err = "Please enter User_ID.";
		} 
		else { 
			$User_ID = trim($_POST["User_ID"]);
		}
		
		// Check if password is empty
		if (empty(trim($_POST["password"]))) { $password_err = "Please enter your password."; } 
		else { $password = trim($_POST["password"]); }
		
		// Validate credentials
		if (empty($User_ID_err) && empty($password_err)) {
			// Prepare a select statement to search from USERS table
			$SQL = "SELECT User_ID, password FROM Users WHERE User_ID = ?";
			
			if ($stmt = mySQLi_prepare($connection, $SQL)) {
				// Bind variables to the prepared statement as parameters
				mySQLi_stmt_bind_param($stmt, "s", $param_User_ID);
				
				// Set parameters
				$param_User_ID = $User_ID;
				
				// Attempt to execute the prepared statement
				if (mySQLi_stmt_execute($stmt)) {
					// Store result
					mySQLi_stmt_store_result($stmt);
					
					// Check if User_ID exists, if yes then verify password
					if (mySQLi_stmt_num_rows($stmt) == 1) {                    
						// Bind result variables
						mySQLi_stmt_bind_result($stmt, $User_ID, $hashed_password);
						if (mySQLi_stmt_fetch($stmt)) {
							if (password_verify($password, $hashed_password)) {
								// Store data in session variables
								$_SESSION["loggedin"] = TRUE;
								$_SESSION["User_ID"] = $User_ID;
								$_SESSION["user_is_mod"] = FALSE;
								// check if user is also a moderator
								$mod_SQL = "SELECT EXISTS (SELECT User_ID FROM Moderators WHERE User_ID = ?)";
								if ($mod_stmt = mySQLi_prepare($connection, $mod_SQL)) {
									mySQLi_stmt_bind_param($mod_stmt, "s", $param_User_ID);
									// Set parameters
									$param_User_ID = $User_ID;
									// Attempt to execute the prepared statement
									if (mySQLi_stmt_execute($mod_stmt)) { 
										mySQLi_stmt_store_result($mod_stmt);
										// Check if user is also a mod, update session as appropriate
										if (mySQLi_stmt_fetch($mod_stmt) === 1) { 
											$_SESSION["user_is_mod"] = TRUE; 
											// Redirect user to welcome page
											header("location: mod_home.php");
										}
										else { 
											// Redirect user to welcome page
											header("location: login_home.php");
										}
									}
									mySQLi_stmt_close($mod_stmt);
								}
							} 
							else {
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid.";
							}
						}
					} 
					else {
						// Display an error message if User_ID doesn't exist
						$User_ID_err = "No account found with that User_ID.";
					}
				}
				else {
					echo "Oops! Something went wrong. Please try again later.";
				}
				// Close statement
				mySQLi_stmt_close($stmt);
			}
		}
		// Close connection
		mySQLi_close($connection);
	}
?>
 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>User ID</label>
                <input type="text" name="User_ID" class="form-control <?php echo (!empty($User_ID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $User_ID; ?>">
                <span class="invalid-feedback"><?php echo $User_ID_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>
