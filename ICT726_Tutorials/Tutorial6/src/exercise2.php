<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Electricity Bill</title>
</head>
<body>
    <div id="page-wrap">
        <h1>PHP - Calculate Electricity Bill</h1>
        <form action="" method="post" id="quiz-form">
            <input type="number" name="units" id="units" placeholder="Please enter Units" required />
            <input type="submit" name="unit-submit" id="unit-submit" value="Submit" />
        </form>

        <?php
        if (isset($_POST['unit-submit'])) {
            $units = $_POST['units'];
            $bill = calculate_bill($units);

            echo "<h3>Total amount for $units units is: AUD $bill</h3>";
        }

        function calculate_bill($units) {
            $amount = 0;

            if ($units <= 50) {
                $amount = $units * 3.50;
            } elseif ($units <= 150) {
                $amount = (50 * 3.50) + (($units - 50) * 4.00);
            } elseif ($units <= 250) {
                $amount = (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
            } else {
                $amount = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
            }

            return number_format((float)$amount, 2, '.', '');
        }
        ?>
    </div>
</body>
</html>
