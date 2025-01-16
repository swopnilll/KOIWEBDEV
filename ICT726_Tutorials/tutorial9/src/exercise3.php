<?php
// regex_constants.php

// 1. Matches 0 to 8 non-space characters
define('REGEX_NON_SPACE_CHARACTERS', '/^\S{0,8}$/');

// 2. Simple password expression: 8 to 16 characters long
define('REGEX_SIMPLE_PASSWORD', '/^[\w!@#$%^&*()_+=-]{8,16}$/');

// 3. Password with at least one letter and one number
define('REGEX_COMPLEX_PASSWORD', '/^(?=.*[a-zA-Z].*)(?=.*\d.*).{8,}$/');

// 4. Month and year in the format mm/yyyy
define('REGEX_MONTH_YEAR', '/^(0[1-9]|1[0-2])\/\d{4}$/');

// 5. URL validation
define('REGEX_URL_VALIDATION', '/^(https?:\/\/)[\w-]+\.[\w.-]+[\/\w.-]*$/');

?>