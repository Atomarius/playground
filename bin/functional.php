<?php

$true = function($t, $f) { return $t; };
$false = function($t, $f) { return $f; };

assert($true('T', 'F') == 'T');
assert($false('T', 'F') == 'F');

$and = function ($b1, $b2) { return $b1($b2, $b1); };
$or = function ($b1, $b2) { return $b1($b1, $b2); };

//assert($and($true, $true)('T', 'F') === 'T'); // == $true('T', 'F') === 'T'
//assert($and($true, $false)('T', 'F') === 'F');
//assert($and($false, $true)('T', 'F') === 'F');
//assert($and($false, $false)('T', 'F') === 'F');
