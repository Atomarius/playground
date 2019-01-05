<?php

namespace Example;

interface ProcessCustomer
{
    public function __invoke(Customer $customer);
}
