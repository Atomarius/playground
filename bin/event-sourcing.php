<?php
use Order\FileSystemRepository;
use Order\Order;
use Order\OrderWasPlaced;
use Order\PaymentWasAccepted;
use Order\PayoutWasCredited;

include '../vendor/autoload.php';

$repo = new FileSystemRepository(getcwd());
//$order = new Order('12345');
//$event = new OrderWasPlaced(['payload' => ['id' => '12345']], time());
//$order->add($event);
//$event = new PaymentWasAccepted(['payload' => ['provider' => 'PayPal']], time());
//$repo->persist($order);

$order = $repo->byId('12345');

echo $order . PHP_EOL;
$order->add(new PaymentWasAccepted(['provider' => 'PayPal'], time()));
echo $order . PHP_EOL;
$order->add(new PayoutWasCredited(['payout' => '50 Gold Coins'], time()));
//$repo->persist($order);
echo $order . PHP_EOL;