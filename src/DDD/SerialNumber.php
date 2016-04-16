<?php

namespace DDD;

/**
 * @ValueObject
 */
class SerialNumber
{
    /** @var string */
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function create()
    {
        return new self(time());
    }
}