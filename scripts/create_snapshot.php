<?php

namespace {

    use OrderService\Domain\Aggregate\Order;
    use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
    use Prooph\EventStore\Projection\ProjectionManager;
    use Prooph\Snapshotter\CategorySnapshotProjection;
    use Prooph\Snapshotter\SnapshotReadModel;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    require_once '../vendor/autoload.php';

    /** @var ContainerBuilder $container */
    $container = include '../container.php';

    $snapshotReadModel = $container->get('snapshotReadModel');

    /** @var ProjectionManager $projectionManager */
    $projectionManager = $container->get('projectionManager');

    $projection = $projectionManager->createReadModelProjection('order_snapshots', $snapshotReadModel);
    $categoryProjection = new CategorySnapshotProjection($projection, Order::class);
    $categoryProjection();
    $projection->run(false);
}
