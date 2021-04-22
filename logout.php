<!-- For logging out. Destroys session data and returns to main homepage -->

<?php
    session_start();
    session_destroy();
    session_unset();
    header("location: home.html");
    exit;
?>