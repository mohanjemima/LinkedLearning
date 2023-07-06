<?php
session_start();

// Logout function
unset($_SESSION['userID']);
unset($_SESSION['logged-in']);

if (empty($_SESSION)) {
    session_destroy();
    session_regenerate_id(true);
}

header("Location: ../log-in.php");
exit;
?>
