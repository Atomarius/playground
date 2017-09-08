<?php

namespace Order;

class OrderWasPlaced extends PurchaseEvent
{
    public function getPrice()
    {
        return isset($this->payload['price']);
    }
}