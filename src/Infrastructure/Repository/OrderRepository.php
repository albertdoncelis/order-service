<?php


namespace OrderService\Infrastructure\Repository;


use OrderService\Domain\Aggregate\Order;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use OrderService\Domain\Repository\OrderRepository as BaseOrderRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator as AggregateTranslatorAlias;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\StreamName;
use Prooph\SnapshotStore\SnapshotStore;

class OrderRepository extends AggregateRepository implements BaseOrderRepository
{

    public function __construct(
        EventStore $eventStore,
        SnapshotStore $snapshotStore = null)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(
                Order::class
            ),
            new AggregateTranslatorAlias(),
            $snapshotStore,
            new StreamName('order'),
            true,
            false,
            []
        );
    }

    /**
     * @param Order $order
     * @return void
     */
    public function save(Order $order): void
    {
        $this->saveAggregateRoot($order);
    }

    /**
     * @param string $orderId
     * @return Order|null
     */
    public function get(string $orderId): ?Order
    {
        return $this->getAggregateRoot($orderId);
    }
}
