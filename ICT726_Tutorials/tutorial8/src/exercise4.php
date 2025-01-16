<?php
// Function to establish a database connection
function getDatabaseConnection($servername, $username, $password, $dbname) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to insert employee data into the database
function insertEmployee($conn, $first, $last, $address, $position) {
    $stmt = $conn->prepare("INSERT INTO employee (firstname, lastname, address, position) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first, $last, $address, $position);

    if ($stmt->execute()) {
        echo "Thank you! Information entered.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Main logic for handling POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $servername = "mysql";
    $username = "root";
    $password = "admin";
    $dbname = "Office";

    // Retrieve user input
    $first = $_POST['first'] ?? '';
    $last = $_POST['last'] ?? '';
    $address = $_POST['address'] ?? '';
    $position = $_POST['position'] ?? '';

    // Validate inputs (basic example)
    if (empty($first) || empty($last) || empty($address) || empty($position)) {
        die("All fields are required.");
    }

    // Establish database connection and insert data
    $conn = getDatabaseConnection($servername, $username, $password, $dbname);
    insertEmployee($conn, $first, $last, $address, $position);
    $conn->close();
} else {
    // Render the HTML form for user input
    ?>
    <form method="post" action="">
        <label for="first">First name:</label>
        <input type="text" id="first" name="first" required><br>
        
        <label for="last">Last name:</label>
        <input type="text" id="last" name="last" required><br>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>
        
        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br>
        
        <input type="submit" value="Enter Information">
    </form>
    <?php
}
?>
