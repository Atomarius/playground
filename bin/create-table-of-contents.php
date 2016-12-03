#!/usr/bin/env php
<?php

$filename = './docs/PROVIDERINTEGRATION.md';
$depth = 3;
$topics = [];
$handle = fopen($filename, 'r');
while ($line = fgets($handle)) {
    if (stripos($line, '#') > 0) {
        continue;
    }
    $hashes = substr_count($line, '#');
    if ($hashes == 1) {
        $title = $line;
    }
    if ($hashes > 1 && $hashes < $depth + 1) {
        $topic = trim(str_replace('#', '', $line));
        $indent = str_repeat(' ', 4 * ($hashes - 2));
        $topics[] = "{$indent}- [{$topic}](#" . str_replace(' ', '-', strtolower($topic)) . ")";
    }
}
$toc = $title . PHP_EOL . implode(PHP_EOL, $topics) . PHP_EOL;
file_put_contents($filename, str_replace($title, $toc, file_get_contents($filename)));

