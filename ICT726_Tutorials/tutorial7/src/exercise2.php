<?php
class Car {
    private $name;
    private $year;

    // Constructor
    public function __construct($name, $year) {
        $this->name = $name;
        $this->year = $year;
    }

    // Destructor
    public function __destruct() {
        echo $this->name . " - " . $this->year;
    }
}

// Create an instance of the Car class
$ford = new Car("Ford", 2029);
?>