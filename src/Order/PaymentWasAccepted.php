<?php

namespace Order;

class PaymentWasAccepted extends PurchaseEvent
{
    public function getPrice()
    {
        return $this->payload['price'];
    }
}