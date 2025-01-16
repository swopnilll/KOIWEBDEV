<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inverse Calculation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; }
        .result { font-size: 1.2em; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Calculate the Inversion of a Number</h2>
    
    <!-- Form for user input -->
    <form method="POST" action="">
        <label for="number">Enter a number:</label>
        <input type="number" id="number" name="number" step="any" required>
        <button type="submit">Calculate</button>
    </form>

    <?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['number'])) {
        $number = sanitizeInput($_POST['number']);
        
        // Function to calculate inverse
        function calculateInverse($number) {
            if ($number == 0) {
                throw new Exception("Division by zero is not allowed.");
            }
            return 1 / $number;
        }

        try {
            // Calculate and display the result
            $inverse = calculateInverse($number);
            echo "<p class='result'>The inverse of the number is: " . number_format($inverse, 5) . "</p>";
        } catch (Exception $exc) {
            echo "<p class='error'>Error: " . $exc->getMessage() . "</p>";
        }
    }

    // Sanitize the user input to avoid injection attacks
    function sanitizeInput($input) {
        return htmlspecialchars(trim($input));
    }
    ?>
</body>
</html>
