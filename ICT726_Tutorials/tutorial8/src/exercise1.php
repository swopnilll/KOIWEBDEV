<?php
// Database connection details
$servername = "mysql";
$username = "root";        
$password = "admin"; 
$dbname = "my_db";     

// Function to handle MySQLi connection
function testMySQLiConnection($servername, $username, $password, $dbname) {
    echo "<h3>Testing MySQLi Connection:</h3>";

    // Create a new MySQLi connection
    $mysqli_conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($mysqli_conn->connect_error) {
        die("Connection failed: " . $mysqli_conn->connect_error);
    }

    echo "Connected successfully to MySQLi<br>";
    $mysqli_conn->close();
}

// Function to handle PDO connection
function testPDOConnection($servername, $username, $password, $dbname) {
    echo "<h3>Testing PDO Connection:</h3>";

    try {
        // Create a new PDO connection
        $pdo_conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // Set PDO error mode to exception
        $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected successfully to PDO<br>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

// Test MySQLi connection
testMySQLiConnection($servername, $username, $password, $dbname);

// Test PDO connection
testPDOConnection($servername, $username, $password, $dbname);
?>
