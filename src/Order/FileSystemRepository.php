<?php

namespace Order;

class FileSystemRepository implements OrderRepository
{
    private $path;

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

        return Order::fromEventStream($id, $events);
    }

    public function persist(Order $order)
    {
        /** @var PurchaseEvent $event */
        foreach ($order->popNewEvents() as $event) {
            file_put_contents($this->filename($order->getId()), json_encode($event->asArray()), FILE_APPEND);
        }
    }
}