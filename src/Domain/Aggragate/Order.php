<?php


namespace OrderService\Domain\Aggregate;


use OrderService\Domain\DomainEvent\OrderWasCanceled;
use OrderService\Domain\DomainEvent\OrderWasCreated;
use OrderService\Domain\GenerateId;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

final class Order extends AggregateRoot
{

    public const CREATED = 'created';
    public const CANCELED = 'canceled';

    private $id, $customerId, $amount, $products, $status;

    public static function createWithData(
        GenerateId $id,
        string $customerId,
        float $amount,
        array $products): self {

        $order = new self;

        $order->recordThat(OrderWasCreated::occur($id,[
            "clientId" => $customerId,
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
        echo "here";die;
    }
}
