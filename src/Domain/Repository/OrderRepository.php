<?php


namespace OrderService\Domain\Repository;


use OrderService\Domain\Aggregate\Order;

interface OrderRepository
{
    /**
     * @param Order $order
     * @return void
     */
    public function save(Order $order): void;

    /**
     * @param string $orderId
     * @return Order|null
     */
    public function get(string $orderId):?Order;
}
