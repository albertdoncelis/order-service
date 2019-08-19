<?php


namespace OrderService\Domain\Aggregate;

use OrderService\Domain\DomainEvent\OrderWasCanceled;
use OrderService\Domain\DomainEvent\OrderWasCreated;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

class Order extends AggregateRoot
{

    public const CREATED = 'created';
    public const CANCELED = 'canceled';

    private $id, $clientId, $amount, $products, $status;

    public static function createWithData(
        string $id,
        string $clientId,
        float $amount,
        array $products): self {

        $order = new self;

        $order->recordThat(OrderWasCreated::occur($id,[
            "clientId" => $clientId,
            "amount" => $amount,
            "products" => json_encode($products),
            "status" => Order::CREATED
        ]));

        return $order;
    }

    public function canceled(string $orderStatus): void {
        if ($this->status === $orderStatus) {
            return ;
        }

        $this->recordThat(OrderWasCanceled::occur($this->id, [
            "status" => Order::CANCELED
        ]));
    }

    protected function aggregateId(): string {
        return $this->id;
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $event): void {
        switch (get_class($event)) {
            case OrderWasCreated::class:
                /** @var OrderWasCreated $event */
                $this->id = $event->aggregateId();
                $this->status = $event->status();
                $this->clientId = $event->clientId();
                $this->amount = $event->amount();
                $this->products = $event->products();
                break;
            case OrderWasCanceled::class:
                /** @var OrderWasCanceled $event */
                $this->id = $event->aggregateId();
                $this->status = $event->status();
        }
    }
}
