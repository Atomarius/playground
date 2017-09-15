<?php

namespace Order;

abstract class PurchaseEvent
{
    protected $payload;

    protected $metadata = [];

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        $parts = explode('\\', get_class($this));
        $this->metadata['_name'] = array_pop($parts);
        $this->payload = $payload;
        $this->metadata['_occurredAt'] = time();
    }

    public function name()
    {
        return $this->metadata['_name'];
    }

    public static function fromArray($data)
    {
        $class = sprintf("%s\%s", __NAMESPACE__, $data['metadata']['_name']);
        $instance = new $class($data['payload']);
        $instance->metadata = $data['metadata'];

        return $instance;
    }

    public function withVersion($version)
    {
        $this->metadata['_version'] = $version;

        return $this;
    }

    public function asArray()
    {
        return ['metadata' => $this->metadata, 'payload' => $this->payload];
    }
}