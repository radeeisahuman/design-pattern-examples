<?php

interface Subject{
    public function request(): void;
}

class RealSubject implements Subject{
    public function request(): void{
        echo "Real Subject: Handling the Request\n";
    }
}

class Proxy implements Subject{
    private RealSubject $subject;

    public function request(): void{
        if($this->checkAccess()){
            $this->subject = new RealSubject();
            $this->subject->request();
            $this->logAccess();
        }
    }

    public function checkAccess(): bool {
        return true;
    }

    public function logAccess(): void{
        echo "Proxy: Logging the time of request\n";
    }
}