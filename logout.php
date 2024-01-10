<?php
session_start(); // Start session

// Clear session data
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
