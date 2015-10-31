#!/usr/bin/env php
<?php
use Profiler\MoneyProfiler;
use Profiler\ValueObjectProfiler;

require __DIR__ . '/../vendor/autoload.php';
chdir(dirname(__DIR__));

$profiler = new MoneyProfiler(10000);

$profiler->execute();

echo PHP_EOL;

$profiler = new ValueObjectProfiler(1000);

$profiler->execute();

echo PHP_EOL;


