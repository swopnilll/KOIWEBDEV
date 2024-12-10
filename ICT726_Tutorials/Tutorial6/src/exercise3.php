<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Calculator</title>
</head>
<body>

    <h1>Simple PHP Calculator</h1>

    <form method="POST" action="">
        <input type="number" name="num1" placeholder="Enter first number" required>
        <input type="number" name="num2" placeholder="Enter second number" required><br><br>

        <input type="submit" name="operation" value="Add">
        <input type="submit" name="operation" value="Subtract">
        <input type="submit" name="operation" value="Multiply">
        <input type="submit" name="operation" value="Divide"><br><br>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operation'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $operation = $_POST['operation'];
            $result = 0;

            // Perform calculation based on the operation selected
            switch ($operation) {
                case 'Add':
                    $result = $num1 + $num2;
                    break;
                case 'Subtract':
                    $result = $num1 - $num2;
                    break;
                case 'Multiply':
                    $result = $num1 * $num2;
                    break;
                case 'Divide':
                    // Handle division by zero
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        $result = "Error! Division by zero.";
                    }
                    break;
                default:
                    $result = "Invalid operation.";
            }

            // Show the result
            echo "<h3>Result: $result</h3>";
        }
    }
    ?>

</body>
</html>
