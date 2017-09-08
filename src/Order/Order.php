<?php

namespace Order;

class Order
{
    /** @var string */
    private $orderId;
    /** @var array */
    private $recordedEvents = [];
    /** @var string */
    private $status;
    /** @var string */
    private $price;

    /**
     * Order constructor.
     * @param $orderId
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getId()
    {
        return $this->orderId;
    }

    public static function fromEventStream($id, array $events)
    {
        $order = new self($id);
        foreach ($events as $event) {
            $order->apply($event);
        }

        return $order;
    }

    public function add(PurchaseEvent $event)
    {
        $this->apply($event);
        $this->recordedEvents[] = $event;
    }

    private function apply(PurchaseEvent $event)
    {
        $handlers['OrderWasPlaced'] = function ($event) { $this->price = $event->getPrice(); $this->status = 'OPEN'; };
        $handlers['PaymentWasAccepted'] = function ($event) { $this->status = 'PAID'; $this->price = $event->getPrice();};
        $handlers['PayoutWasCredited'] = function ($event) { $this->status = 'CLOSED'; };

        isset($handlers[$event->name()]) && $handlers[$event->name()]($event);
    }

    public function popRecordedEvents()
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }

    public function __toString()
    {
        return "{$this->orderId} - {$this->status}";
    }

}