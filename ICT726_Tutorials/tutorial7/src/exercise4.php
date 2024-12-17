<?php

class CircleArea {
    private $radius;
    
    const PI = 3.14;

    // Constructor
    public function __construct($radius) {
        $this->radius = $radius;
        $this->displayArea();
    }

    // Method to calculate area
    private function calculateArea() {
        return self::PI * pow($this->radius, 2);
    }

    // Method to display area
    private function displayArea() {
        $area = $this->calculateArea();
        echo "The area of the circle with radius {$this->radius} is: {$area}";
    }

    // Destructor
    public function __destruct() {
        echo "\nObject destroyed.";
    }
}

// Create an instance of the class
$r = new CircleArea(5);

?>
