<?php

interface Product{
    public function execute(): void;
}

class ConcreteProductA implements Product{
    public function execute(): void {
        echo "Concrete Product A has been executed";
    }
}

class ConcreteProductB implements Product{
    public function execute(): void {
        echo "Concrete Product B has been executed";
    }
}

abstract class Factory{
    abstract public function FactoryMethod(): Product;

    public function CreateProduct(){
        $product = $this->FactoryMethod();
        return $product;
    }
}

class ConcreteFactoryA extends Factory{
    public function FactoryMethod(): Product{
        return new ConcreteProductA();
    }
}

class ConcreteFactoryB extends Factory{
    public function FactoryMethod(): Product{
        return new ConcreteProductB();
    }
}