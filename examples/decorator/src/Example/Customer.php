<?php

namespace Example;

class Customer
{
    /** @var CustomerId */
    private $id;
    /** @var array */
    private $attributes = [];

    /**
     * @param CustomerId $id
     * @param array $attributes
     */
    public function __construct(CustomerId $id, array $attributes)
    {
        $this->id = $id;
        $this->attributes = $attributes;
    }

    /**
     * @return CustomerId
     */
    public function id(): CustomerId
    {
        return $this->id;
    }
}
