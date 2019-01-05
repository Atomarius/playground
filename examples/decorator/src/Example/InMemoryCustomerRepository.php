<?php

namespace Example;

class InMemoryCustomerRepository implements CustomerRepository
{
    /** @var Customer[] */
    private $customers = [];

    /**
     * @param Customer[] $customers
     */
    public function __construct(array $customers = [])
    {
        $this->customers = $customers;
    }

    public function withId(CustomerId $anId): Customer
    {
        return $this->customers[(string) $anId] ?? new Customer($anId, []);
    }

    public function add(Customer $aCustomer)
    {
        $this->customers[(string) $aCustomer->id()] = $aCustomer;
    }
}
