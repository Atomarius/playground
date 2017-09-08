<?php

namespace Order;

class Order
{
    private $orderId;

    private $recordedEvents;

    private $status = 'OPEN';

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
        if ($event instanceof PaymentWasAccepted) {
            $this->status = 'PAID';
        }

        if ($event instanceof PayoutWasCredited) {
            $this->status = 'CLOSED';
        }
    }

    public function popRecordedEvents()
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }
}