<?php

namespace DDD;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function copiedMoneyShouldRepresentSameValue()
    {
        $aMoney = new Money(100, new Currency('USD'));
        $copiedMoney = Money::fromMoney($aMoney);
        $this->assertTrue($aMoney->equals($copiedMoney));
    }

    /**
     * @test
     */
    public function originalMoneyShouldNotBeModifiedOnAddition()
    {
        $aMoney = new Money(100, new Currency('USD'));
        $aMoney->add(new Money(20, new Currency('USD')));
        $this->assertEquals(100, $aMoney->amount());
    }

    /**
     * @test
     */
    public function moneysShouldBeAdded()
    {
        $aMoney = new Money(100, new Currency('USD'));

        $newMoney = $aMoney->add(new Money(20, new Currency('USD')));
        $this->assertEquals(120, $newMoney->amount());
    }
// ...
}