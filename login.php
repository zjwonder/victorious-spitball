<!-- login code from: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php -->

<?php
 
	// Check if the user is already logged in. If yes, then redirect him to welcome page
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
		header("location: home.html"); // MIGHT NEED TO CHANGE TO new_advertisement.php
		exit;
	}
	 
	// Include config file
	require_once "connection.php";
	 
	// Define variables and initialize with empty values
	$login = "";
	$password = "";
	$login_err = "";
	$password_err = "";

	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 
		// Check if login is empty
		if (empty(trim($_POST["login"]))) { // THIS VALUE MUST BE SET TO login 
			$login_err = "Please enter login.";
		} 
		else {
			$login = trim($_POST["login"]); // THIS VALUE MUST BE SET TO login 
		}
		
		// Check if password is empty
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter your password.";
		} 
		else {
			$password = trim($_POST["password"]);
		}
		
		// Validate credentials
		if (empty($login_err) && empty($password_err)) {
			
			// Prepare a select statement
			$sql = "SELECT User_ID, password FROM users WHERE User_ID = ?";
			
			if($stmt = mysqli_prepare($connection, $sql)) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_login);
				
				// Set parameters
				$param_login = $login;
				
				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Store result
					mysqli_stmt_store_result($stmt);
					
					// Check if login exists, if yes then verify password
					if (mysqli_stmt_num_rows($stmt) == 1) {   
					
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $login);
						
						if (mysqli_stmt_fetch($stmt)) {
							// Password is correct, so start a new session
							session_start();
							
							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["login"] = $login;                            
							
							// Redirect user to new_advertisement.php
							//header("location: home.html");
							header("location: new_advertisement.php");
							
						} 
						else {
							// Display an error message if password is not valid
							$password_err = "The password you entered was not valid.";
						}
					}
					else {
						// Display an error message if login doesn't exist
						$login_err = "No account found with that login.";
					}
				}
			} 
			else {
				echo "Oops! Something went wrong. Please try again later.";
			}
			// Close statement
			mysqli_stmt_close($stmt);
		}
		// Close connection
		mysqli_close($connection);
	}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($login_err)) ? 'has-error' : ''; ?>">
                <label>login</label>
                <input type="text" name="login" class="form-control" value="<?php echo $login; ?>">
                <span class="help-block"><?php echo $login_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    
</body>
</html>
