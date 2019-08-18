<?php


namespace OrderService\Projection;


use OrderService\Domain\DomainEvent\OrderWasCreated;

class OrderProjection
{
    /** @var \PDO $PDO */
    private $PDO;

    public function __construct(\PDO $PDO)
    {
        $this->PDO = $PDO;
    }

    public function onOrderCreated(OrderWasCreated $orderWasCreated) {
        $this->PDO->prepare("INSERT INTO `read_orders` SET client_id=?, amount=?, products=?");
    }

}
