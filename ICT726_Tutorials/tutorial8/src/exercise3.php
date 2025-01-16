<?php
// Database connection details
$servername = "mysql";
$username = "root";
$password = "admin";
$dbname = "myDb";

// Data to insert
$guests = [
    ['firstname' => 'Pratigya', 'lastname' => 'Sharma', 'email' => 'pratigya.sharma@example.com'],
    ['firstname' => 'Swopnil', 'lastname' => 'Acharya', 'email' => 'swopnil.acharya@example.com'],
];

// Function to handle MySQLi operations
function handleMySQLiOperations($servername, $username, $password, $dbname, $guests) {
    echo "<h3>MySQLi Operations:</h3>";

    // Establish MySQLi connection
    $mysqli_conn = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli_conn->connect_error) {
        die("Connection failed: " . $mysqli_conn->connect_error);
    }

    echo "Connected successfully to MySQLi<br>";

    // Insert data
    foreach ($guests as $guest) {
        $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES 
                ('{$guest['firstname']}', '{$guest['lastname']}', '{$guest['email']}')";
        if ($mysqli_conn->query($sql) === TRUE) {
            echo "New record created successfully for {$guest['firstname']}<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli_conn->error;
        }
    }

    // Retrieve data
    $result = $mysqli_conn->query("SELECT * FROM MyGuests");

    if ($result->num_rows > 0) {
        echo "<h4>Stored Records:</h4>";
        while ($row = $result->fetch_assoc()) {
            echo "ID: {$row['id']} - Name: {$row['firstname']} {$row['lastname']} - Email: {$row['email']}<br>";
        }
    } else {
        echo "No records found<br>";
    }

    $mysqli_conn->close();
}

// Function to handle PDO operations
function handlePDOOperations($servername, $username, $password, $dbname, $guests) {
    echo "<h3>PDO Operations:</h3>";

    try {
        // Establish PDO connection
        $pdo_conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected successfully to PDO<br>";

        // Insert data
        $stmt = $pdo_conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");

        foreach ($guests as $guest) {
            $stmt->execute($guest);
            echo "New record created successfully for {$guest['firstname']}<br>";
        }

        // Retrieve data
        $stmt = $pdo_conn->prepare("SELECT * FROM MyGuests");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            echo "<h4>Stored Records:</h4>";
            foreach ($result as $row) {
                echo "ID: {$row['id']} - Name: {$row['firstname']} {$row['lastname']} - Email: {$row['email']}<br>";
            }
        } else {
            echo "No records found<br>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();

    } finally {
        $pdo_conn = null;

    }
}

// Execute MySQLi and PDO operations
handleMySQLiOperations($servername, $username, $password, $dbname, $guests);
handlePDOOperations($servername, $username, $password, $dbname, $guests);

?>
