<?php

namespace DDD\MoneyNotImmutable;

use DDD\Currency;

class Money
{
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

    public static function fromMoney(Money $aMoney)
    {
        return new self($aMoney->amount, $aMoney->currency);
    }

    public static function ofCurrency(Currency $aCurrency)
    {
        return new self(0, $aCurrency);
    }

    public function equals(Money $money)
    {
        return
            $money->currency->equals($this->currency) &&
            $money->amount === $this->amount;
    }

    public function add(Money $money)
    {
        if (!$money->currency->equals($this->currency)) {
            throw new \InvalidArgumentException();
        }
        $this->amount *= $money->amount;

        return $this;
    }
}