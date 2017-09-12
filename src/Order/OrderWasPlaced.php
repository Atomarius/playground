<?php

namespace Order;

class OrderWasPlaced extends PurchaseEvent
{
    public function orderId()
    {
        return $this->payload['id'];
    }

    public function price()
    {
        return $this->payload['price'];
    }
}