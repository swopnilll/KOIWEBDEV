<?php
// Database connection details
$dsn = "mysql:host=mysql;dbname=Office"; // Use "localhost" if not using Docker
$username = "root";
$password = "admin";

// Function to establish a database connection
function getPDOConnection($dsn, $username, $password) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Function to handle form actions
function handleFormActions($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create'])) {
            createEmployee($pdo, $_POST);
        } elseif (isset($_POST['update'])) {
            updateEmployee($pdo, $_POST);
        } elseif (isset($_POST['delete'])) {
            deleteEmployee($pdo, $_POST['EmpID']);
        }
    }
}

// CRUD Operations
function createEmployee($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO Employees (EmpName, EmpAddress, Salary, Hiredate) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data['EmpName'], $data['EmpAddress'], $data['Salary'], $data['Hiredate']]);
}

function updateEmployee($pdo, $data) {
    $stmt = $pdo->prepare("UPDATE Employees SET EmpName = ?, EmpAddress = ?, Salary = ?, Hiredate = ? WHERE EmpID = ?");
    $stmt->execute([$data['EmpName'], $data['EmpAddress'], $data['Salary'], $data['Hiredate'], $data['EmpID']]);
}

function deleteEmployee($pdo, $empID) {
    $stmt = $pdo->prepare("DELETE FROM Employees WHERE EmpID = ?");
    $stmt->execute([$empID]);
}

function fetchEmployees($pdo) {
    $stmt = $pdo->query("SELECT * FROM Employees");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Main logic
$pdo = getPDOConnection($dsn, $username, $password);
handleFormActions($pdo);
$employees = fetchEmployees($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations with PDO</title>
</head>
<body>
    <h1>CRUD Operations: Employees Table</h1>

    <!-- Create/Update Form -->
    <form method="post" action="">
        <input type="hidden" name="EmpID" value="<?= isset($_POST['edit']) ? htmlspecialchars($_POST['EmpID']) : ''; ?>">
        <label>Employee Name:</label>
        <input type="text" name="EmpName" value="<?= isset($_POST['edit']) ? htmlspecialchars($_POST['EmpName']) : ''; ?>" required><br>
        <label>Address:</label>
        <input type="text" name="EmpAddress" value="<?= isset($_POST['edit']) ? htmlspecialchars($_POST['EmpAddress']) : ''; ?>" required><br>
        <label>Salary:</label>
        <input type="number" name="Salary" step="0.01" value="<?= isset($_POST['edit']) ? htmlspecialchars($_POST['Salary']) : ''; ?>" required><br>
        <label>Hire Date:</label>
        <input type="date" name="Hiredate" value="<?= isset($_POST['edit']) ? htmlspecialchars($_POST['Hiredate']) : ''; ?>" required><br>
        <button type="submit" name="<?= isset($_POST['edit']) ? 'update' : 'create'; ?>">
            <?= isset($_POST['edit']) ? 'Update' : 'Create'; ?>
        </button>
    </form>

    <h2>Employee List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>EmpID</th>
                <th>EmpName</th>
                <th>EmpAddress</th>
                <th>Salary</th>
                <th>Hiredate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= htmlspecialchars($employee['EmpID']); ?></td>
                    <td><?= htmlspecialchars($employee['EmpName']); ?></td>
                    <td><?= htmlspecialchars($employee['EmpAddress']); ?></td>
                    <td><?= htmlspecialchars($employee['Salary']); ?></td>
                    <td><?= htmlspecialchars($employee['Hiredate']); ?></td>
                    <td>
                        <!-- Edit Form -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="EmpID" value="<?= htmlspecialchars($employee['EmpID']); ?>">
                            <input type="hidden" name="EmpName" value="<?= htmlspecialchars($employee['EmpName']); ?>">
                            <input type="hidden" name="EmpAddress" value="<?= htmlspecialchars($employee['EmpAddress']); ?>">
                            <input type="hidden" name="Salary" value="<?= htmlspecialchars($employee['Salary']); ?>">
                            <input type="hidden" name="Hiredate" value="<?= htmlspecialchars($employee['Hiredate']); ?>">
                            <button type="submit" name="edit">Edit</button>
                        </form>

                        <!-- Delete Form -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="EmpID" value="<?= htmlspecialchars($employee['EmpID']); ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
