<?php

namespace Order;

/**
 * Equals OrderWasPaid ? true : false
 */
class PaymentWasAccepted extends PurchaseEvent
{
    public function price()
    {
        return $this->payload['price'];
    }

    public function payout()
    {
        return $this->payload['payout'];
    }
}