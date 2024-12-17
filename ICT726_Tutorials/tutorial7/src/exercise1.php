<?php
class Car {
    private $name;
    private $year;

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_year($year) {
        $this->year = $year;
    }

    public function get_year() {
        return $this->year;
    }
}

// Create an instance of the Car class
$ford = new Car();

// Set the properties using class methods
$ford->set_name("Ford");
$ford->set_year(2204);

// Print the properties
echo $ford->get_name() . " - " . $ford->get_year();
?>