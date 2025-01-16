<?php
// Database connection details
$servername = "mysql";
$username = "root";
$password = "admin";

// Function to establish a PDO connection
function connectToServer($servername, $username, $password) {
    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected to MySQL server successfully<br>";
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Function to create a database if it doesn't exist
function createDatabase($conn, $dbname) {
    try {
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $conn->exec($sql);
        echo "Database '$dbname' created successfully or already exists<br>";
        $conn->exec("USE $dbname");
    } catch (PDOException $e) {
        die("Database creation failed: " . $e->getMessage());
    }
}

// Function to create a table if it doesn't exist
function createTable($conn, $tableName) {
    try {
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $conn->exec($sql);
        echo "Table '$tableName' created successfully<br>";
    } catch (PDOException $e) {
        die("Table creation failed: " . $e->getMessage());
    }
}

// Main script execution
$dbname = "myDb";
$tableName = "MyGuests";

// Establishing connection to the server
$conn = connectToServer($servername, $username, $password);

// Creating the database and table
createDatabase($conn, $dbname);
createTable($conn, $tableName);

// Closing the connection
$conn = null;
?>
