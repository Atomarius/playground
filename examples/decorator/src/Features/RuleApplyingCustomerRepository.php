<?php

namespace Example\Feature;

use Example\Customer;
use Example\CustomerRepository;
use Example\CustomerRule;

class RuleApplyingCustomerRepository implements CustomerRepository
{
    /** @var CustomerRepository */
    private $customers;
    /** @var CustomerRule[] */
    private $rules = [];

    /**
     * @param CustomerRepository $customers
     * @param CustomerRule[] $rules
     */
    public function __construct(CustomerRepository $customers, array $rules)
    {
        $this->customers = $customers;
        $this->rules = $rules;
    }

    public function withId(CustomerId $anId): Customer
    {
        $customer = $this->customers->withId($anId);

        foreach ($this->rules as $applyTo) {
            $applyTo($customer);
        }

        return $customer;
    }

    public function add(Customer $aCustomer)
    {
        $this->customers->add($aCustomer);
    }
}
