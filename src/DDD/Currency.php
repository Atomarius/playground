<?php
namespace DDD;

class Currency
{
    const PATTERN = '/^[A-Z]{3}$/';

    private $isoCode;

    public function __construct($anIsoCode)
    {
        $this->setIsoCode($anIsoCode);
    }

    private function setIsoCode($anIsoCode)
    {
        if (!preg_match(self::PATTERN, $anIsoCode)) {
            throw new \InvalidArgumentException('');
        }
        $this->isoCode = $anIsoCode;
    }

    public function isoCode()
    {
        return $this->isoCode;
    }

    public function equals(Currency $currency)
    {
        return $currency->isoCode === $this->isoCode();
    }
}