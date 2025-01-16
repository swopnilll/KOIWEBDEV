<?php

// Initialize variables and error messages
$name = $email = $website = $comment = $gender = "";
$errors = [
    "nameErr" => "", 
    "emailErr" => "", 
    "websiteErr" => "", 
    "genderErr" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    $errors['nameErr'] = validateName($_POST["name"]);
    $name = ($errors['nameErr'] == "") ? test_input($_POST["name"]) : '';

    // Validate Email
    $errors['emailErr'] = validateEmail($_POST["email"]);
    $email = ($errors['emailErr'] == "") ? test_input($_POST["email"]) : '';

    // Validate Website
    $errors['websiteErr'] = validateWebsite($_POST["website"]);
    $website = ($errors['websiteErr'] == "") ? test_input($_POST["website"]) : '';

    // Validate Comment (optional)
    $comment = !empty($_POST["comment"]) ? test_input($_POST["comment"]) : '';

    // Validate Gender
    $errors['genderErr'] = validateGender($_POST["gender"]);
    $gender = ($errors['genderErr'] == "") ? test_input($_POST["gender"]) : '';
}

// Function to sanitize input
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Validation functions
function validateName($name) {
    if (empty($name)) {
        return "Name is required";
    }
    if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
        return "Only letters and white space are allowed";
    }
    return "";
}

function validateEmail($email) {
    if (empty($email)) {
        return "Email is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    return "";
}

function validateWebsite($website) {
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        return "Invalid URL";
    }
    return "";
}

function validateGender($gender) {
    if (empty($gender)) {
        return "Gender is required";
    }
    return "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <h2>Form Validation Example</h2>
    <p><span class="error">* Required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $errors['nameErr'];?></span>
        <br><br>

        E-mail: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $errors['emailErr'];?></span>
        <br><br>

        Website: <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $errors['websiteErr'];?></span>
        <br><br>

        Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br><br>

        Gender:
        <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked";?>>Female
        <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked";?>>Male
        <input type="radio" name="gender" value="Other" <?php if ($gender == "Other") echo "checked";?>>Other
        <span class="error">* <?php echo $errors['genderErr'];?></span>
        <br><br>

        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // Display the submitted data if no errors
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors['nameErr']) && empty($errors['emailErr']) && empty($errors['websiteErr']) && empty($errors['genderErr'])) {
        echo "<h2>Your Input:</h2>";
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Website: $website<br>";
        echo "Comment: $comment<br>";
        echo "Gender: $gender<br>";
    }
    ?>
</body>
</html>
