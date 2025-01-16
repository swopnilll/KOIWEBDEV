<?php
require 'config.php'; // Include the modularized database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare a parameterized SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user_data = $result->fetch_assoc();

        // Verify the password (hashed comparison is recommended)
        if (password_verify($password, $user_data['password'])) {
            // Set session and cookie for the logged-in user
            $_SESSION['user_id'] = $user_data['id'];
            setcookie('user_id', $user_data['id'], time() + (86400 * 30), "/"); // Cookie valid for 30 days
            header('Location: welcome.php');
            exit(); // Ensure script stops after redirection
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "Invalid username.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div style="margin: 100px; text-align: center;">
    <h2>Login</h2>
    <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <?php
    if (isset($login_error)) {
        echo "<p style='color: red;'>$login_error</p>";
    }
    ?>
</div>
</body>
</html>
