<?php

namespace Order;

abstract class PurchaseEvent
{
    protected $name;

    protected $payload;

    protected $createdAt;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->payload = $data['payload'];
        $this->createdAt = $data['createdAt'];
    }

    public static function fromArray($data)
    {
        return new $data['name']($data);
    }

    public function asArray()
    {
        return ['name' => $this->name, 'payload' => $this->payload, 'createdAt' => $this->createdAt];
    }
}