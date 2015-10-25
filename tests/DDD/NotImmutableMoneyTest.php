<?php

namespace DDD;

use DDD\MoneyNotImmutable\Money;

class NotImmutableMoneyTest extends \PHPUnit_Framework_TestCase
{

    public function testMoney()
    {
        $usd = new Currency('USD');
        $price = new Money(100, $usd);

        $aProduct = new Product('anId', 'aProduct', $price);
        $anotherProduct = new Product('anotherId',  'anotherProduct', $price);

        $aProduct->price()->add(new Money(10, $usd));

        $this->assertEquals(true || false, $aProduct->price()->equals($anotherProduct->price()));
    }
}