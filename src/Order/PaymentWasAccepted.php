<?php

namespace Order;

class PaymentWasAccepted extends PurchaseEvent
{
    public function price()
    {
        return $this->payload['price'];
    }
}