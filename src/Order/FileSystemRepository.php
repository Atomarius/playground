<?php

namespace Order;

class FileSystemRepository implements OrderRepository
{
    private $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    private function filename($id)
    {
        return "{$this->path}/{$id}.order";
    }

    public function byId($id)
    {
        $events = [];
        $lines = file($this->filename($id));
        foreach ($lines as $event) {
            $events[] = PurchaseEvent::fromArray(json_decode($event, true));
        }

        return Order::fromEventStream($events);
    }

    public function save(Order $order)
    {
        /** @var PurchaseEvent $event */
        foreach ($order->popRecordedEvents() as $event) {
            file_put_contents($this->filename($order->getId()), json_encode($event->asArray()).PHP_EOL, FILE_APPEND);
        }
    }
}