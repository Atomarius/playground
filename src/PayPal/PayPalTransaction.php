<?php

namespace PayPal;

interface PayPalTransaction
{
    /**
     * @return string
     */
    public function getPayerId();
}