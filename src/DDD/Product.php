<?php

namespace DDD;


class Product
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var */
    private $price;

    /**
     * Product constructor.
     * @param $price
     * @param $name
     * @param $id
     */
    public function __construct($id, $name, $price)
    {
        $this->price = $price;
        $this->name = $name;
        $this->id = $id;
    }

    public function price()
    {
        return $this->price;
    }
}