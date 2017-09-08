<?php
use Order\FileSystemRepository;
use Order\Order;
use Order\OrderWasPlaced;
use Order\PaymentWasAccepted;

include '../vendor/autoload.php';

$repo = new FileSystemRepository(getcwd());
//$order = new Order('12345');
//$event = new OrderWasPlaced(['payload' => ['id' => '12345']], time());
//$order->add($event);
//$event = new PaymentWasAccepted(['payload' => ['provider' => 'PayPal']], time());
//$order->add($event);
//
//$repo->persist($order);

$order = $repo->byId('12345');

echo PHP_EOL . print_r($order, true) . PHP_EOL;

$order->add(new \Order\PayoutWasCredited(['payout' => '50 Gold Coins'], time()));
//$repo->persist($order);

echo PHP_EOL . print_r($order, true) . PHP_EOL;