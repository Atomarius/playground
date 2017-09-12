<?php

namespace Order;

abstract class Aggregate implements EventRecording
{
    private $version = 0;
    private $recordedEvents = [];

    protected function __construct()
    {
    }

    /**
     * @param array $events
     * @return Aggregate
     */
    public static function fromEventStream(array $events)
    {
        $aggregate = new static();
        foreach ($events as $event) {
            $aggregate->apply($event);
        }

        return $aggregate;
    }

    public function add(PurchaseEvent $event)
    {
        $this->recordedEvents[] = $event->withVersion($this->version++);
        $this->apply($event);
    }

    public function popRecordedEvents()
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }

    abstract protected function apply(PurchaseEvent $event);
}
