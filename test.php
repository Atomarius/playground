<?php
const COUNTRY_CODE = 0;
const CURRENCY = 3;
const PRICE = 4;
const PREMIUM_POKER = 6;
const PREMIUM_CAFE = 7;
const PREMIUM_GALAXY = 8;

$countries = include 'config/countries.php';
$currencies = [
    3 => 'Poker normal',
    4 => 'Poker premium',
    8 => 'Disco premium',
    6 => 'Cafe normal',
    7 => 'Cafe premium',
    1 => 'Fashion normal',
    2 => 'Fashion premium',
    5 => 'Gangster premium',
    12 => 'Empire premium',
    9 => 'Galaxy premium',
    11 => 'BigFarm premium',
    249 => 'ShadowKings premium',
    397 => 'LegendsOfHonor Web premium',
];
$countriesAsString = "'" . implode("','", $countries) ."'";

$sqlQuery = <<<SQL
  SELECT
  `item`.`countryCode`,
  CONCAT_WS(
  '-',
  `item`.`idProvider`,
  `item`.`idNetwork`,
  `item`.`countryCode`,
  `item`.`price`,
  `item`.`currencyCode`,
  `itemPayout`.`amount`,
  `itemPayout`.`idGameCurrency`
  ) AS hashstring
  FROM `shop`.`item`
    JOIN `shop`.`itemPayout` ON `item`.`id` = `itemPayout`.`idItem`
  WHERE `item`.`countryCode` IN ({$countriesAsString})
    AND `item`.`idProvider`=11
    AND `item`.`active`=1
  ORDER BY hashstring
SQL;

$config = include 'config/mysql.php';
$pdo = new PDO($config['dns'], $config['username'], $config['passwd']);
$stmt = $pdo->query($sqlQuery);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$hashesFromDb = [];
foreach ($result as $row) {
    $hashesFromDb[$row['countryCode']][] = $row['hashstring'];
}

$hashesFromFile = [];
if (($handle = fopen('boku_all_countries-hc_currency_v1.2.csv', 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ';', '"', '"')) !== false) {
        if ($data[COUNTRY_CODE] == 'CountryCode') {
            continue;
        }
        $num = count($data);
        $idProvider=11;
        $countryCode = $data[COUNTRY_CODE];
        if (!in_array($countryCode, $countries)) {
            continue;
        }

        $price = (int)str_replace('.', '', str_replace(',', '', $data[PRICE]));
        $currencyCode = $data[CURRENCY];
        $premiumPoker = str_replace('.', '', $data[PREMIUM_POKER]);
        $premiumCafe = str_replace('.', '', $data[PREMIUM_CAFE]);
        $premiumGalaxy = str_replace('.', '', $data[PREMIUM_GALAXY]);

        $hashPrefix = "{$idProvider}-1-{$countryCode}-{$price}-{$currencyCode}";
        $hashes = [
            "{$hashPrefix}-" . $premiumPoker*1000  . "-3",
            "{$hashPrefix}-{$premiumPoker}-4",
            "{$hashPrefix}-{$premiumPoker}-8",
            "{$hashPrefix}-" . $premiumCafe*1000 . "-6",
            "{$hashPrefix}-{$premiumCafe}-7",
            "{$hashPrefix}-" . $premiumCafe*1000 . "-1",
            "{$hashPrefix}-{$premiumCafe}-2",
            "{$hashPrefix}-{$premiumGalaxy}-5",
            "{$hashPrefix}-{$premiumGalaxy}-12",
            "{$hashPrefix}-{$premiumGalaxy}-9",
            "{$hashPrefix}-{$premiumGalaxy}-11",
            "{$hashPrefix}-{$premiumGalaxy}-249",
            "{$hashPrefix}-{$premiumGalaxy}-397",

        ];
        isset($hashesFromFile[$countryCode]) || $hashesFromFile[$countryCode] = [] ;
        $hashesFromFile[$countryCode] = array_merge($hashesFromFile[$countryCode], $hashes);
    }
    fclose($handle);

    foreach ($hashesFromFile as $countryCode => $hashes) {
        if (!isset($hashesFromDb[$countryCode])) {
            echo PHP_EOL . $countryCode . '::' . (count($hashes)) . '::0';
            continue;
        }
        echo PHP_EOL . $countryCode . '::' . (count($hashes)) . '::' . count($hashesFromDb[$countryCode]);
        foreach ($hashes as $hash) {
            if (!in_array($hash, $hashesFromDb[$countryCode])) {
                echo PHP_EOL . "Item missing {$hash} " . $currencies[array_pop(explode('-', $hash))];
            }
        }
    }

    echo PHP_EOL . 'FINISHED' . PHP_EOL;
}
