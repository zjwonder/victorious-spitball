<?php

require_once "connection.php";
 
$User_ID = $password = $confirm_password = "";
$User_ID_err = $password_err = $confirm_password_err = "";
 
if($_SERVER['REQUEST_METHOD]'] == 'POST')
{
    // User_ID validation
    if (empty(trim($_POST['User_ID'])))
    {
        $User_ID_err = "User ID is a required field."
    } 
    else 
    {
        $SQL = "SELECT User_ID FROM Users WHERE User_ID = ?";
        if ($statement = mysqli_prepare($link, $SQL))
        {
            mysqli_stmt_bind_param($statement, "s", $User_ID);
            $User_ID = trim($_POST['User_ID']);

            if (mysqli_stmt_execute($statement))
            {
                mysqli_stmt_store_result($statement)
                if (mysqli_stmt_num_rows($statement) == 1) { $User_ID_err = "Sorry, this User ID is unavailable."; }
                else { $User_ID = trim($_POST['User_ID']); }
            }
            else { echo "Connection Error! Please try again later." }
            mysqli_stmt_close($statement)
        }
    }

    // Password validation
    if(empty(trim($_POST['password']))) 
    { $password_err = "Password is a required field." }
    elseif(!(preg_match('/[A-Za-z]/', trim($_POST['password'])) && )) 
    { $password_err = "Password must be at least 7 characters" }
    else { $password = trim($_POST['password']) }

    // Confirm password validation
    if(empty(trim($_POST['confirm_password']))) 
    { $confirm_password_err = "Confirm password is a required field" }
    else 
    {
        $confirm_password = trim($_POST['confirm_password'])
        if (empty($password_err) && ($password != $confirm_password)) 
        { $confirm_password_err = "Password confirmation does not match" }
    }
}
?>