<?php
//Logout function
unset($_SESSION['userID']);

if (empty($_SESSION)) {
    session_regenerate_id(true);
    session_destroy();
}
header("Location: ../log-in.php");
exit;

