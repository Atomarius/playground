<?php

namespace Order;

class Order
{
    private $orderId;

    private $projection;

    private $events;

    private $newEvents;

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
        $this->newEvents[] = $event;
    }

    private function apply(PurchaseEvent $event)
    {
        if ($event instanceof OrderWasPlaced) {

        }

        $this->events[] = $event;
    }

    public function popNewEvents()
    {
        $events = $this->newEvents;
        $this->newEvents = [];
        return $events;
    }
}