#!/usr/bin/php
<?php
use Profiler\MoneyProfiler;
use Profiler\ValueObjectProfiler;

require __DIR__ . '/../vendor/autoload.php';
chdir(dirname(__DIR__));

foreach(glob('src/Profiler/*Profiler.php') as $file)
{
    $class = str_replace(['src/Profiler/', '.php'], ['\Profiler\\'], $file);
    if($class == '\Profiler\Profiler') continue;
    /** @var \Profiler\Profiler $class */
    $class = new $class(1000);
    $class->execute();
    echo PHP_EOL;
}


