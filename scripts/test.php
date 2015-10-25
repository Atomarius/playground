#!/usr/bin/env php
<?php
use DDD\Currency;

require __DIR__ . '/../vendor/autoload.php';
chdir(dirname(__DIR__));

$profiler = new \DDD\Profiler\MoneyProfiler(100000);
$profiler->profile();
foreach ($profiler->getMessages() as $mess) {
    echo PHP_EOL . $mess;
}
echo PHP_EOL;


