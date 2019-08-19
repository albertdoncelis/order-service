<?php


namespace OrderService\Domain\Command;


use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

final class CreateOrder extends Command
{
    use PayloadTrait;

    public function id(): string {
        return $this->payload['id'];
    }

    public function amount(): float {
        return $this->payload['amount'];
    }

    public function products(): array {
        return $this->payload['products'];
    }

    public function clientId(): string {
        return $this->payload['clientId'];
    }
}
