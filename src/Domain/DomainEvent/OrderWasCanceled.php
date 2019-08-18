<?php


namespace OrderService\Domain\DomainEvent;


use OrderService\Domain\Aggregate\Order;
use Prooph\EventSourcing\AggregateChanged;

class OrderWasCanceled extends AggregateChanged
{
    public function status(): string {
        return $this->payload['status'];
    }

}
