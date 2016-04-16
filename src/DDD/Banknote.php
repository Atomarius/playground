<?php

namespace DDD;

/**
 * @Entity
 */
class Banknote
{
    /** @var SerialNumber */
    private $serialNumber;
    /** @var Money */
    private $value;

    /**
     * @param SerialNumber $aSerialNumber
     * @param Money        $aValue
     */
    public function __construct(SerialNumber $aSerialNumber, Money $aValue)
    {
        $this->serialNumber = $aSerialNumber;
        $this->value = $aValue;
    }

    public static function fromMoney(Money $aValue)
    {
        return new self(SerialNumber::create(), $aValue);
    }
}