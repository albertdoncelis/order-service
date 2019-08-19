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

//        print_r($orderWasCreated);

        $clientId = $orderWasCreated->clientId();
        $amount = $orderWasCreated->amount();
        $products = $orderWasCreated->products();
        $status = $orderWasCreated->status();
        $aggregateId = $orderWasCreated->aggregateId();
        $dateCreated = Date('Y-m-d H:i:s', $orderWasCreated->createdAt()->getTimestamp());

        $query = $this->PDO->prepare("INSERT INTO
            `read_orders` SET order_id= :orderId,
            client_id= :clientId, amount= :amount, products= :products, status= :status, created_at= :createdAt");
        $query->bindParam(':clientId', $clientId, \PDO::PARAM_STR);
        $query->bindParam(':amount', $amount,\PDO::PARAM_INT);
        $query->bindParam(
            ':products',
            $products, \PDO::PARAM_STR);
        $query->bindParam(':status', $status, \PDO::PARAM_STR);
        $query->bindParam(':orderId', $aggregateId, \PDO::PARAM_STR);
        $query->bindParam(':createdAt',
            $dateCreated,
            \PDO::PARAM_STR);
//
        $query->execute();

    }

    public function onOrderCanceled(OrderWasCanceled $orderWasCanceled) {
        $query = $this->PDO->prepare('UPDATE `read_order` SET status= ? WHERE id = ?');
        $query->bindValue(1, $orderWasCanceled->status());
        $query->bindValue(2, $orderWasCanceled->aggregateId());
        $query->execute();
    }

}
