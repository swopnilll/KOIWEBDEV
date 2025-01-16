<?php
// Start the session
session_start();

// Clear all session variables
$_SESSION = [];

// Delete the session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/'); // Expire the session cookie
}

// Destroy the session
session_destroy();

// Clear the user_id cookie if it exists
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/'); // Expire the user_id cookie
}

// Redirect to the login page
header('Location: index.php');
exit(); // Stop further script execution after redirection
