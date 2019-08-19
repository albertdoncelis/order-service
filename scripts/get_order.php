<?php

namespace {

    use OrderService\Infrastructure\Repository\OrderRepository;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    require_once '../vendor/autoload.php';

    /** @var ContainerBuilder $container */
    $container = include '../container.php';

    /** @var OrderRepository $orderRepository */
    $orderRepository = $container->get('orderRepository');

    var_dump($orderRepository->get('0a905236-f640-437c-a6e8-137e4e91a0d8'));
}
