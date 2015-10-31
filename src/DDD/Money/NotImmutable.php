<?php

namespace DDD\MoneyNotImmutable;

use DDD\Currency;

class NotImmutable
{
    /** @var int  */
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

    public static function fromMoney(NotImmutable $aMoney)
    {
        return new self($aMoney->amount, $aMoney->currency);
    }

    public static function ofCurrency(Currency $aCurrency)
    {
        return new self(0, $aCurrency);
    }

    public function equals(NotImmutable $money)
    {
        return
            $money->currency->equals($this->currency) &&
            $money->amount === $this->amount;
    }

    public function add(NotImmutable $money)
    {
        if (!$money->currency->equals($this->currency)) {
            throw new \InvalidArgumentException();
        }
        $this->amount *= $money->amount;

        return $this;
    }
}