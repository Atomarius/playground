<?php

namespace Example;

interface CustomerRepository
{
    public function withId(CustomerId $anId): Customer;
    public function add(Customer $aCustomer);
}
