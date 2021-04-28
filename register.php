<!-- Registration page for new users -->

<?php

    session_start();

    require_once "connection.php";
    
    $User_ID = $password = $confirm_password = $UserFirst = $UserLast = "";
    $User_ID_err = $User_ID_Taken_err = $password_err = $confirm_password_err = $UserFirst_err = $UserLast_err = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // User_ID validation
        if (empty(trim($_POST['User_ID']))) {
            $User_ID_err = "User ID is a required field.";
        }
		
		
        /*else {
            
            if ($statement = mysqli_prepare($link, $SQL)) {
                mysqli_stmt_bind_param($statement, "s", $User_ID);
                $User_ID = trim($_POST['User_ID']);

                if (mysqli_stmt_execute($statement)) {
                    mysqli_stmt_store_result($statement);
                    if (mysqli_stmt_num_rows($statement) == 1) { $User_ID_err = "Sorry, this User ID is unavailable."; }
                    else { $User_ID = trim($_POST['User_ID']); }
                }
                else { echo "Connection Error! Please try again later."; }
                mysqli_stmt_close($statement);
            }
        }*/

        // Password validation
        if(empty(trim($_POST['password']))) { 
            $password_err = "Password is a required field.";
        }
        elseif(!(preg_match('/[A-Za-z]/', trim($_POST['password'])))) { 
            $password_err = "Password must be at least 7 characters";
        }
        else { 
            $password = trim($_POST['password']);
        }
		
		if(empty(trim($_POST['UserFirst']))) { 
            $UserFirst_err = "First Name is a required field.";
        }
        else { 
            $UserFirst = trim($_POST['UserFirst']);
        }
		
		if(empty(trim($_POST['UserLast']))) { 
            $UserLast_err = "First Name is a required field.";
        }
        else { 
            $UserLast = trim($_POST['UserLast']);
        }

        // Confirm password validation
        if(empty(trim($_POST['confirm_password']))) { 
            $confirm_password_err = "Confirm password is a required field";
        }
        else {
            $confirm_password = trim($_POST['confirm_password']);
            if (empty($password_err) && ($password != $confirm_password)) { 
                $confirm_password_err = "Password confirmation does not match";
            }	
        }
		if (empty($User_ID_err) && empty($password_err) && empty($UserFirst_err) && empty($UserLast_err)&& empty($confirm_password_err)&& empty($User_ID_Taken_err)) {
			$User_ID=isset($_POST['User_ID'])?$_POST['User_ID']:"";
			$password=isset($_POST['password'])?$_POST['password']:"";
			$UserFirst=isset($_POST['UserFirst'])?$_POST['UserFirst']:"";
			$UserLast=isset($_POST['UserLast'])?$_POST['UserLast']:"";
			$SQL = "insert into Users (User_ID, UserFirst, UserLast, password) VALUES (";
			$SQL.= "'".$User_ID."', '".$UserFirst."', '".$UserLast."', '".$password."')";
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
    <title>New User Registration</title>
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
        <h2>User Registration</h2>
        <p>Do the thing.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="UserFirst" class="form-control <?php echo (!empty($UserFirst_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $$UserFirst_err; ?></span>
            </div> 
			<div class="form-group">
                <label>Last Name</label>
                <input type="text" name="UserLast" class="form-control <?php echo (!empty($UserLast_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $$UserLast_err; ?></span>
            </div> 
			<div class="form-group">
                <label>Username</label>
                <input type="text" name="User_ID" class="form-control <?php echo (!empty($User_ID_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $$User_ID_err; ?></span>
            </div> 
			<div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>  
			<div class="form-group">
                <label>Confirm Password</label>
                <input type="text" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>  
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>