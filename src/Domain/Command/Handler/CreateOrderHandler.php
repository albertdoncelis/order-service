<?php


namespace OrderService\Domain\Command\Handler;


use OrderService\Domain\Aggregate\Order;
use OrderService\Domain\Command\CreateOrder;
use OrderService\Domain\Repository\OrderRepository;

final class CreateOrderHandler
{
    /** @var OrderRepository $repository */
    private $repository;

    public function __construct(OrderRepository $orderRepository) {
        $this->repository = $orderRepository;
    }

    /**
     * @param CreateOrder $createOrder
     */
    public function __invoke(CreateOrder $createOrder): void {
        $order = Order::createWithData(
            $createOrder->id(),
            $createOrder->clientId(),
            $createOrder->amount(),
            $createOrder->products());

        $this->repository->save($order);
    }
}
