<?php

namespace Order;

class Order extends Aggregate
{
    /** @var string */
    private $orderId;
    /** @var string */
    private $status;
    /** @var string */
    private $price;

    public function id()
    {
        return $this->orderId;
    }

    protected function apply(PurchaseEvent $event)
    {
        $handlers['OrderWasPlaced'] = function ($event) { $this->orderId = $event->orderId(); $this->status = 'OPEN'; $this->price = $event->price(); };
        $handlers['PaymentWasAccepted'] = function ($event) { $this->status = 'PAID'; $this->price = $event->price();};
        $handlers['PayoutWasCredited'] = function ($event) { $this->status = 'CLOSED'; };

        isset($handlers[$event->name()]) && $handlers[$event->name()]($event);
    }

    public function __toString()
    {
        return "{$this->orderId} - {$this->status}";
    }
}