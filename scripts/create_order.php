<?php

namespace {

    use OrderService\Domain\Aggregate\Order;
    use OrderService\Domain\Command\CancelOrder;
    use OrderService\Domain\Command\CreateOrder;

    use Prooph\ServiceBus\CommandBus;
    use Prooph\ServiceBus\Plugin\Router\CommandRouter;
    use Ramsey\Uuid\Uuid;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    require_once '../vendor/autoload.php';

    /** @var ContainerBuilder $container */
    $container = include '../container.php';


    /** @var CommandBus $commandBus */
    $commandBus = $container->get('commandBus');


    /** @var CommandRouter $commandRouter */
    $commandRouter = $container->get('commandRouter');

    $eventBus = $container->get('eventBus');

    $eventPublisher = $container->get('eventPublisher');

    $snapshotStore = $container->get('snapshotStore');

    $projectionManager = $container->get('projectionManager');

    $orderProjector = $container->get('orderProjector');
    $eventRouter = $container->get('eventRouter');

    $commandBus->dispatch(new CreateOrder([
        'id' => Uuid::uuid4()->toString(),
        'amount' => 100.1,
        'products' => ['product-1', 'product-2'],
        'clientId' => Uuid::uuid4()->toString(),
    ]));
//
//    $commandBus->dispatch(new CreateOrder([
//        'id' => 'canceled-' . Uuid::uuid4()->toString(),
//        'amount' => 100.1,
//        'products' => ['product-1', 'product-2'],
//        'customerId' => Uuid::uuid4()->toString()
//    ]));
//
//    $commandBus->dispatch(new CancelOrder([
//        'id' => 'canceled',
//        'status' => Order::CANCELED
//    ]));

}



