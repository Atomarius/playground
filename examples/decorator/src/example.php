<?php

include __DIR__ . '/bootstrap.php';

$customers = new \Example\InMemoryCustomerRepository([]);

$aCustomerId = new \Example\CustomerId('my-first-customer');
$aCustomer = new \Example\Customer($aCustomerId, []);

$customers->add($aCustomer);

$customers = new \Example\ProcessingCustomerRepository(
    $customers,
    [
        new \Example\EchoCustomerId()
    ]
);

$customers->withId($aCustomerId);