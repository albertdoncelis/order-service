<?php


namespace OrderService\Domain\Command;


use OrderService\Domain\Aggregate\Order;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

class CancelOrder extends Command
{
    use PayloadTrait;

    public function id(): string {
        return $this->payload['id'];
    }

    public function status(): string {
        return Order::CANCELED;
    }
}
