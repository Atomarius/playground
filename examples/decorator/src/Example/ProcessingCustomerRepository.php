<?php

namespace Example;

use Example\Customer;
use Example\CustomerId;
use Example\CustomerRepository;
use Example\ProcessCustomer;

class ProcessingCustomerRepository implements CustomerRepository
{
    /** @var CustomerRepository */
    private $customers;
    /** @var ProcessCustomer[] */
    private $processors = [];

    /**
     * @param CustomerRepository $customers
     * @param ProcessCustomer[] $rules
     */
    public function __construct(CustomerRepository $customers, array $rules)
    {
        $this->customers = $customers;
        $this->processors = $rules;
    }

    public function withId(CustomerId $anId): Customer
    {
        $customer = $this->customers->withId($anId);
        /** @var ProcessCustomer $process */
        foreach ($this->processors as $process) {
            $process($customer);
        }

        return $customer;
    }

    public function add(Customer $aCustomer)
    {
        $this->customers->add($aCustomer);
    }
}
