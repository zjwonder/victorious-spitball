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

    // from here we should pull users from database and have an option to delete them
?>