<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count from 5 to 15</title>
</head>
<body>

<h3>Using "for" Loop:</h3>
<?php
for ($count = 5; $count <= 15; $count++) {
    echo "Count: $count <br>";
}
?>

<h3>Using "while" Loop:</h3>
<?php
$count = 5;
while ($count <= 15) {
    echo "Count: $count <br>";
    $count++;
}
?>

</body>
</html>
