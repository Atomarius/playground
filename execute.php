<?php
$config = include 'config/mysql.php';
$countries = include 'config/countries.php';
$pdo = new PDO($config['dns'], $config['username'], $config['passwd']);

foreach ($countries as $country) {
    foreach (glob("pricepoints/{$country}/*") as $filename) {
        $statement = file_get_contents($filename);
        try {
            $pdo->exec($statement);
        } catch (PDOException $pdoEx) {
            echo PHP_EOL . "Error executing {$filename}: {$pdoEx->getMessage()}";
        }
    }
}

echo PHP_EOL;
