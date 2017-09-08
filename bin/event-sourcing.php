<?php
use Order\FileSystemRepository;
use Order\Order;
use Order\OrderWasPlaced;
use Order\PaymentWasAccepted;
use Order\PayoutWasCredited;

include '../vendor/autoload.php';

$repo = new FileSystemRepository(getcwd());
$id = '123456789';
$order = new Order($id);
echo $order . PHP_EOL;
$order->add(new OrderWasPlaced(['id' => $id, 'price' => '4.99 EUR'], time()));
echo $order . PHP_EOL;
$order->add(new PaymentWasAccepted(['provider' => 'PayPal', 'price' => '4.98 EUR'], time()));
echo $order . PHP_EOL;
$order->add(new PayoutWasCredited(['provider' => 'PayPal'], time()));
echo $order . PHP_EOL;
$repo->persist($order);
$order = $repo->byId('123456789');

var_dump($order);


//$repo->persist($order);