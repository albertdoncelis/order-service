<?php


namespace OrderService\Domain\Command\Handler;


use OrderService\Domain\Command\CancelOrder;
use OrderService\Domain\Repository\OrderRepository;


final class CancelOrderHandler
{
    /** @var OrderRepository $repository  */
    private $repository;

    public function __construct(OrderRepository $orderRepository) {
        $this->repository = $orderRepository;
    }

    public function __invoke(CancelOrder $cancelOrder): void {
       $order = $this->repository->get($cancelOrder->id());
       $order->canceled($cancelOrder->status());
       $this->repository->save($order);
    }
}
