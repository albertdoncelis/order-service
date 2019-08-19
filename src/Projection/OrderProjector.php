<?php


namespace OrderService\Projection;


use OrderService\Domain\DomainEvent\OrderWasCanceled;
use OrderService\Domain\DomainEvent\OrderWasCreated;

class OrderProjector
{
    /** @var \PDO $PDO */
    private $PDO;

    public function __construct(\PDO $PDO)
    {
        $this->PDO = $PDO;
    }

    public function onOrderCreated(OrderWasCreated $orderWasCreated) {

        $query = $this->PDO->prepare("INSERT INTO 
            `read_orders` SET order_id= :orderId, 
            client_id= :clientId, amount= :amount, products= :products, status= :status, created_at= :createdAt");
        $query->bindParam(':clientId', $orderWasCreated->clientId(), \PDO::PARAM_STR);
        $query->bindParam(':amount', $orderWasCreated->amount(),\PDO::PARAM_INT);
        $query->bindParam(
            ':products',
            $orderWasCreated->products(), \PDO::PARAM_STR);
        $query->bindParam(':status', $orderWasCreated->status(), \PDO::PARAM_STR);
        $query->bindParam(':orderId', $orderWasCreated->aggregateId(), \PDO::PARAM_STR);
        $query->bindParam(':createdAt',
            Date('Y-m-d H:i:s', $orderWasCreated->createdAt()->getTimestamp()),
            \PDO::PARAM_STR);

        $query->execute();

    }

    public function onOrderCanceled(OrderWasCanceled $orderWasCanceled) {
        $query = $this->PDO->prepare('UPDATE `read_order` SET status= ? WHERE id = ?');
        $query->bindValue(1, $orderWasCanceled->status());
        $query->bindValue(2, $orderWasCanceled->aggregateId());
        $query->execute();
    }

}
