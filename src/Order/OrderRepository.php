<?php

namespace Order;

interface OrderRepository
{
    public function byId($id);

    public function persist(Order $order);
}