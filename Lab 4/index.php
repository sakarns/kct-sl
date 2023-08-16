<?php

// Parent class
class Animal
{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function eat()
    {
        echo "{$this->name} is eating. <br>";
    }

    public function sleep()
    {
        echo "{$this->name} is sleeping. <br>";
    }
}

// Child class inheriting from Animal
class Dog extends Animal
{
    private $breed;

    public function __construct($name, $age, $breed)
    {
        parent::__construct($name, $age);
        $this->breed = $breed;
    }

    public function bark()
    {
        echo "{$this->name} is barking. Woof! <br>";
    }

    public function displayInfo()
    {
        echo "Name: {$this->name}<br>";
        echo "Age: {$this->age}<br>";
        echo "Breed: {$this->breed}<br>";
    }
}

// Create an instance of the Dog class
$dog = new Dog("Max", 3, "Labrador");

// Access methods from the parent class
$dog->eat();
$dog->sleep();

// Access methods specific to the Dog class
$dog->bark();
$dog->displayInfo();
