<?php

namespace {

    use Prooph\EventStore\Projection\ProjectionManager;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    require_once '../vendor/autoload.php';

    /** @var ContainerBuilder $container */
    $container = include '../container.php';

    /** @var ProjectionManager $projectionManager */
    $projectionManager = $container->get('projectionManager');

    $projectionManager->resetProjection('order');

    echo 'Replay done';

}
