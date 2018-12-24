<?php

namespace Example;

interface CustomerRule
{
    public function __invoke(Customer $customer);
}
