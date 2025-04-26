<?php

/*

🧩 Problem:
You need to build a Pizza 🍕 object.

A Pizza has:

Dough (e.g., "Thin Crust", "Thick Crust")

Sauce (e.g., "Tomato", "Pesto")

Toppings (e.g., "Pepperoni", "Mushrooms", etc.)

🎯 Your Task:
Create a Pizza class (the Product).

Create a PizzaBuilder interface that has:

buildDough()

buildSauce()

buildToppings()

getResult()

Create a MargheritaPizzaBuilder (Concrete Builder) that builds a Margherita pizza.

Create a Director class that defines the sequence of building a pizza.

In the client code, build a Margherita pizza using the builder and director.

*/

class Pizza {
    public string $dough;
    public string $sauce;
    public string $toppings;

    public function serve(){
        echo "Pizza served with " . $this->dough . ", the sauce is " . $this->sauce . " and " . $this->toppings;
    }
}

interface PizzaBuilder{
    public function buildDough(): void;
    public function buildSauce(): void;
    public function buildToppings(): void;
    public function getResult(): Pizza;
}

class MargheritaPizzaBuilder{
    private Pizza $pizza; 
    
    public function __construct(){
        $this->pizza = new Pizza();
    }

    public function buildDough(): void{
        $this->pizza->dough = "Normal Dough";
    }
    
    public function buildSauce(): void{
        $this->pizza->sauce = "Wine Sauce";
    }

    public function buildToppings(): void{
        $this->pizza->toppings = "Lots of Cheese";
    }

    public function getResult(): Pizza{
        return $this->pizza;
    }
}

class Director{
    public function buildMargherittaPizza(MargheritaPizzaBuilder $m_pizza): Pizza{
        $m_pizza->buildDough();
        $m_pizza->buildSauce();
        $m_pizza->buildToppings();
        return $m_pizza->getResult();
    }
}

$m_builder = new MargheritaPizzaBuilder();
$director = new Director();

$pizza = $director->buildMargherittaPizza($m_builder);
$pizza->serve();