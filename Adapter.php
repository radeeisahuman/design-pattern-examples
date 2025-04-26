<?php

interface Target{
    public function request(): string;
}

class Adaptee{
    public function specificRequest(): string{
        echo "Made a specific request";
    }
}

class Adapter implements Target{
    private Adaptee $adaptee;

    public function __construct(){
        $this->adaptee = new Adaptee();
    }

    public function request(): string{
        $this->adaptee->specificRequest();
    }
}

function clientCode(Target $target){
    echo $target->request();
}

/*

🧩 Adapter Pattern Problem
Scenario:
You have an old payment system in your company that looks like this:

php
Copy
Edit
class OldPaymentGateway {
    public function makePayment(int $amount) {
        echo "Paid {$amount} using OldPaymentGateway.";
    }
}
But now, your new application expects all payment systems to implement this new interface:

php
Copy
Edit
interface PaymentProcessor {
    public function pay(int $amount): void;
}
✅ You cannot change the OldPaymentGateway class (it's legacy code).
✅ You must make it usable in the new system that expects a PaymentProcessor.

🛠️ Your task:
Create an Adapter class that implements PaymentProcessor.

Inside the Adapter, make sure the OldPaymentGateway can still be used.

Write a small client code that shows the new system working with your Adapter.

*/

interface PaymentProcessor {
    public function pay(int $amount): void;
}

class OldPaymentGateway {
    public function makePayment(int $amount) {
        echo "Paid {$amount} using OldPaymentGateway.";
    }
}

class PaymentAdapter implements PaymentProcessor{
    private OldPaymentGateway $old_payment_method;

    public function __construct(){
        $this->old_payment_method = new OldPaymentGateway();
    }

    public function pay(int $amount){
        $this->old_payment_method->makePayment($amount);
    }
}

function paymentClient(PaymentProcessor $processor, int $amount){
    $processor->pay($amount);
}