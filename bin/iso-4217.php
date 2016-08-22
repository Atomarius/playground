#!/usr/bin/php
<?php
$xml = simplexml_load_file('http://www.currency-iso.org/dam/downloads/lists/list_one.xml');
$array = json_decode(json_encode($xml), true);
$currencies = [];

foreach ($array['CcyTbl']['CcyNtry'] as $country) {
    if (isset($country['CcyMnrUnts']) && $country['CcyMnrUnts'] <> 2) {
        $currencies[$country['Ccy']] = $country;
    }
}
echo count($currencies) . PHP_EOL;