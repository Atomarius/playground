<?php

namespace Order;

abstract class PurchaseEvent
{
    protected $name;

    protected $payload;

    protected $occurredAt;

    /**
     * @param $payload
     * @param $occurredAt
     */
    public function __construct($payload, $occurredAt)
    {
        $parts = explode('\\', get_class($this));
        $this->name = array_pop($parts);
        $this->payload = $payload;
        $this->occurredAt = $occurredAt;
    }

    public static function fromArray($data)
    {
        $class = sprintf("%s\%s", __NAMESPACE__, $data['name']);
        return new $class($data['payload'], $data['occurredAt']);
    }

    public function asArray()
    {
        return ['name' => $this->name, 'payload' => $this->payload, 'occurredAt' => $this->occurredAt];
    }
}