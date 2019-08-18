<?php


namespace OrderService\Domain\DomainEvent;


use Prooph\EventSourcing\AggregateChanged;

final class OrderWasCreated extends AggregateChanged
{

    public function clientId(): string {
        return $this->payload['clientId'];
    }

    public function amount(): float {
        return $this->payload['amount'];
    }

    public function products(): string {
        return $this->payload['products'];
    }
}
