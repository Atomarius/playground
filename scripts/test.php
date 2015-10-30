#!/usr/bin/env php
<?php
use DDD\Profiler\MoneyProfiler;
use DDD\Profiler\ValueObjectProfiler;

require __DIR__ . '/../vendor/autoload.php';
chdir(dirname(__DIR__));

//$profiler = new MoneyProfiler(10000);
//
//$profiler->execute();
//
//foreach ($profiler->getMessages() as $mess) {
//    echo PHP_EOL . $mess;
//}
//echo PHP_EOL;

$profiler = new ValueObjectProfiler(10000);

$profiler->execute();

foreach ($profiler->getMessages() as $mess) {
    echo PHP_EOL . $mess;
}
echo PHP_EOL;


