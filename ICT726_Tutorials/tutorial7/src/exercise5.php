<?php

// Define an abstract class Fruit
abstract class Fruit {
    protected $name;

    // Constructor to initialize fruit name
    public function __construct($name) {
        $this->name = $name;
    }

    // Abstract method for color
    abstract public function color();
}

// Child class Apple
class Apple extends Fruit {
    public function __construct() {
        parent::__construct("Apple");
    }

    public function color() {
        echo "$this->name is red." . PHP_EOL;
    }
}

// Child class Orange
class Orange extends Fruit {
    public function __construct() {
        parent::__construct("Orange");
    }

    public function color() {
        echo "$this->name is orange." . PHP_EOL;
    }
}

// Child class Grape
class Grape extends Fruit {
    public function __construct() {
        parent::__construct("Grape");
    }

    public function color() {
        echo "$this->name is purple." . PHP_EOL;
    }
}

// Create objects and call color method
$apple = new Apple();
$apple->color();

$orange = new Orange();
$orange->color();

$grape = new Grape();
$grape->color();

?>
