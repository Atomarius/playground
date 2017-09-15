<?php
use Order\FileSystemRepository;
use Order\Order;
use Order\OrderWasPlaced;
use Order\PaymentWasAccepted;
use Order\PayoutWasCredited;

include '../vendor/autoload.php';

$repo = new FileSystemRepository(getcwd());
$order = $repo->byId('123456789');
echo $order . PHP_EOL;
$order->add(new PaymentWasAccepted(['provider' => 'PayPal', 'price' => '4.98 EUR']));
echo $order . PHP_EOL;
$order->add(new PayoutWasCredited(['payout' => '50.000 Rubies']));
echo $order . PHP_EOL;
// $repo->save($order);
$order = $repo->byId('123456789');

var_dump($order);


//$repo->persist($order);