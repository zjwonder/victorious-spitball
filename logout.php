<?php
    $_SESSION["loggedin"] = FALSE;
    $_SESSION["User_ID"] = "";
    $_SESSION["user_is_mod"] = FALSE;
    header("location: home.html");
?>