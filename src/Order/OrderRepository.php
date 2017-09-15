<?php

namespace Order;

interface OrderRepository
{
    /**
     * @param $id
     * @return Order
     */
    public function byId($id);

    /**
     * @param Order $order
     * @return mixed
     */
    public function save(Order $order);
}