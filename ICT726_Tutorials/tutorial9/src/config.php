<?php
// Database connection details
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'my_db');

// Create a connection using the mysqli extension
function createDatabaseConnection() {
    // Establish the connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to create users table
function createUsersTable($conn) {
    $create_table_query = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
    
    if ($conn->query($create_table_query) === TRUE) {
        echo "Table 'users' created successfully!";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

// Initialize connection and create the table
$conn = createDatabaseConnection();
createUsersTable($conn);

// Close the connection
$conn->close();
?>
