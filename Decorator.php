<?php

interface Product{
    public function execute(): void;
}

class ConcreteProductA implements Product{
    public function execute(): void{
        echo "concrete product A created";
    }
}

class ConcreteProductB implements Product{
    public function execute(): void{
        echo "concrete product B created";
    }
}

class ConcreteProductC implements Product{
    public function execute(): void{
        echo "concrete product C created";
    }
}

abstract class BaseDecorator implements Product{
    protected Product $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function execute(): void{
        $this->product->execute();
    }
}

class DecoratorA extends BaseDecorator{
    public function execute(): void{
        echo "Decorator A added";
        $this->product->execute();
    }
}

class DecoratorB extends BaseDecorator{
    public function execute(): void{
        echo "Decorator B added";
        $this->product->execute();
    }
}

class DecoratorC extends BaseDecorator{
    public function execute(): void{
        echo "Decorator C added";
        $this->product->execute();
    }
}


