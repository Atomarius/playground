<?php

namespace DDD\Money;

use DDD\Currency;

class DirectAccess
{
    /** @var int */
    protected $amount;
    /** @var Currency */
    protected $currency;

    public function __construct($anAmount, Currency $aCurrency)
    {
        $this->amount = (int) $anAmount;
        $this->currency = $aCurrency;
    }

    public function amount()
    {
        return $this->amount;
    }

    public function currency()
    {
        return $this->currency;
    }

    public static function fromMoney(DirectAccess $aMoney)
    {
        return new self($aMoney->amount, $aMoney->currency);
    }

    public static function ofCurrency(Currency $aCurrency)
    {
        return new self(0, $aCurrency);
    }

    public function equals(DirectAccess $money)
    {
        return
            $money->currency->equals($this->currency) &&
            $money->amount === $this->amount;
    }

    public function add(DirectAccess $money)
    {
        if (!$money->currency->equals($this->currency)) {
            throw new \InvalidArgumentException();
        }
        return new self(
            $money->amount + $this->amount,
            $this->currency
        );
    }

    /**
     * @param float $rate
     * @param Currency $currency
     *
     * @return DirectAccess
     */
    public function convertTo($rate, $currency)
    {
        return new self($this->amount * $rate, $currency);
    }
}