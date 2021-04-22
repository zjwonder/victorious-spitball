<?php
    if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE) {
        header("location: home.html");
        exit;
    }
    elseif (!$_SESSION["user_is_mod"]) { 
        header("location: login_home.php"); 
        exit;
    }

    require_once "connection.php";

    // need to get ads from database and have options to delete or change the status of each one
?>