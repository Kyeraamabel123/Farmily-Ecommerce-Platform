<?php
session_start(); 

// Checking if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login if not authenticated
    exit();
}

session_destroy(); // Destroying all session data
header("Location: index.php"); // Redirecting the user to the login page
exit(); 
?>
