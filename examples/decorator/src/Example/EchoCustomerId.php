<?php

namespace Example;

class EchoCustomerId implements ProcessCustomer
{
    public function __invoke(Customer $customer)
    {
        echo $customer->id() . PHP_EOL;
    }
}
