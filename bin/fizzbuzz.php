#!/usr/bin/php
<?php

for ($i = 0; $i < 100; $i++) {
    echo (($i % 3 == 0 || $i % 5 == 0) ? ($i % 3 == 0 ? 'Fizz' : '') . ($i % 5 == 0 ? 'Buzz' : '') : $i) . PHP_EOL;
}