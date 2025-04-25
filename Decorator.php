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


/*
Practice Problem — Implement Your Own Decorators in PHP
Scenario

You’ve joined a small SaaS company that lets users export reports in different formats (CSV, PDF, XLSX). Management now wants to let customers optionally:

Encrypt the exported file (AES‑256).

Compress it (ZIP).

Digitally sign it (RSA signature).

The key requirements:

Each option is independent and can be turned on/off at run‑time per download.

Options may be combined in any order (e.g., compress → encrypt → sign or sign → compress, etc.).

The existing ReportExporter class must not be modified.

Your Task
Define a clean interface (Exporter) containing a single method public function export(string $data): string that returns the path/filename of the generated file.

Create ReportExporter (concrete component) that writes $data to a plain .txt file and returns its path.

Implement three concrete decorators—EncryptedExporter, CompressedExporter, and SignedExporter—that each wrap another Exporter and add the corresponding feature before/after delegating.

You may stub out the actual crypto/zip logic with placeholder comments; focus on structure.

Demonstrate in client code how to:

Export a report with compression ➔ encryption.

Export a report with signing only.

Export a report with encryption ➔ signing ➔ compression.

*/

interface Exporter{
    public function export(string $data): string;
}

class ReportExporter implements Exporter{
    public function export(string $data): string{
        return "Report Exported - " . $data;
    }
}

abstract class ExportDecorator implements Exporter{
    protected Exporter $exporter;

    public function __construct(Exporter $exporter){
        $this->exporter = $exporter;
    }

    public function export(string $data): string{
        return $this->exporter->export($data);
    }
}

class EncryptedExporter extends ExportDecorator{
    public function encrypt(){
        return "Data Encrypted";
    }

    public function export(string $data): string{
        parent::export($data) . self::encrypt();
    }
}

class CompressedExporter extends ExportDecorator{
    public function compress(){
        return "Data Compressed";
    }

    public function export(string $data): string{
        parent::export($data) . self::compress();
    }
}

class SignedExporter extends ExportDecorator{
    public function sign(){
        return "Data Signed";
    }

    public function export(string $data): string{
        parent::export($data) . self::sign();
    }
}

// Export a report with compression ➔ encryption.

$new_exporter = new ReportExporter();
$new_exporter = new CompressedExporter($new_exporter);
$new_exporter = new EncryptedExporter($new_exporter);

echo $new_exporter->export("New Exporter");

// Export a report with signing only.

$signed_exporter = new ReportExporter();
$signed_exporter = new SignedExporter($signed_exporter);

echo $signed_exporter->export("Signed Exporter");

//Export a report with encryption ➔ signing ➔ compression.

$full_exporter = new ReportExporter();
$full_exporter = new EncryptedExporter($full_exporter);
$full_exporter = new SignedExporter($full_exporter);
$full_exporter = new CompressedExporter($full_exporter);

echo $full_exporter->export("The full course");