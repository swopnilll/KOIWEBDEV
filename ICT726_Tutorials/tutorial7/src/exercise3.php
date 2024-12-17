<?php
// Parent Class
class Car {
    public $name;
    public $year;

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // Method to print car details
    public function printDetails() {
        echo "Car Name: $this->name\n";
    }
}

// Child Class
class Ford extends Car {
    public $country;

    // Constructor
    public function __construct($name, $country) {
        parent::__construct($name); // Call parent constructor
        $this->country = $country;
    }

    // Override method to print car details with country
    public function printDetails() {
        echo "Car Name: $this->name - Country: $this->country\n";
    }
}

// Create an instance of the child class
$myCar = new Ford("Ford", "USA");
$myCar->printDetails();

?>
