<?php
require 'config.php'; // Include the database configuration file
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
    header('Location: index.php');
    exit(); // Stop further script execution
}

// Get the user ID from session or cookie
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_COOKIE['user_id'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user_data = $result->fetch_assoc();
} else {
    // If the user does not exist, force logout
    header('Location: logout.php');
    exit();
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <div>
        <h2>Welcome, <?php echo htmlspecialchars($user_data['username'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
