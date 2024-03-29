<?php

namespace {

    use OrderService\Domain\Aggregate\Order;
    use Prooph\EventStore\Projection\ProjectionManager;
    use Prooph\Snapshotter\CategorySnapshotProjection;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    require_once '../vendor/autoload.php';

    /** @var ContainerBuilder $container */
    $container = include '../container.php';

    $snapshotReadModel = $container->get('snapshotReadModel');

    /** @var ProjectionManager $projectionManager */
    $projectionManager = $container->get('projectionManager');

    $projection = $projectionManager->createReadModelProjection('order', $snapshotReadModel);
    $categoryProjection = new CategorySnapshotProjection($projection, 'order');
    $categoryProjection();
    $projection->run(false);
}
