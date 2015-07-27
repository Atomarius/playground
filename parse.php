<?php
const COUNTRY_CODE = 0;
const CURRENCY = 3;
const PRICE = 4;
const PREMIUM_POKER = 6;
const PREMIUM_CAFE = 7;
const PREMIUM_GALAXY = 8;

$countries = include 'config/countries.php';
$deactivateSql = file_get_contents('templates/deactivate.sql');
$insertSql = file_get_contents('templates/insert.sql');
$idProvider = 11;
$row = 1;

if (($handle = fopen('boku_all_countries-hc_currency_v1.2.csv', 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ';', '"', '"')) !== false) {
        if (!in_array($data[COUNTRY_CODE], $countries)) {
            continue;
        }
        $num = count($data);
        echo PHP_EOL . "{$num} Felder in Zeile {$row}:";
        $row++;
        $price = str_replace('.', '', str_replace(',', '', $data[PRICE]));
//        $output = str_replace(':countryCode', $data[COUNTRY_CODE], $insertSql);
//        $output = str_replace(':currency', $data[CURRENCY], $output);
//        $output = str_replace(':price', $price, $output);
//        $output = str_replace(':idProvider', $idProvider, $output);
//        $output = str_replace(':payoutPremiumPoker', str_replace('.', '', $data[PREMIUM_POKER]), $output);
//        $output = str_replace(':payoutPremiumCafe', str_replace('.', '', $data[PREMIUM_CAFE]), $output);
//        $output = str_replace(':payoutPremiumGalaxy', str_replace('.', '', $data[PREMIUM_GALAXY]), $output);
        $search = [
            ':countryCode',
            ':currency',
            ':price',
            ':idProvider',
            ':payoutPremiumPoker',
            ':payoutPremiumCafe',
            ':payoutPremiumGalaxy',
        ];
        $replace = [
            $data[COUNTRY_CODE],
            $data[CURRENCY],
            $price,
            $idProvider,
            str_replace('.', '', $data[PREMIUM_POKER]),
            str_replace('.', '', $data[PREMIUM_CAFE]),
            str_replace('.', '', $data[PREMIUM_GALAXY])
        ];
        $dir = "pricepoints/{$data[COUNTRY_CODE]}";
        is_dir($dir) || mkdir($dir);
        file_put_contents("{$dir}/{$data[COUNTRY_CODE]}-000-deactivate.sql", str_replace(':countryCode', $data[COUNTRY_CODE], $deactivateSql));
        file_put_contents("{$dir}/{$data[COUNTRY_CODE]}-{$data[CURRENCY]}-{$price}.sql", str_replace($search, $replace, $insertSql));
    }
    echo PHP_EOL . 'FINISHED' . PHP_EOL;
    fclose($handle);
}
