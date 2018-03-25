<?php 

namespace Alegra\Factory;

use Alegra\Controller\WarehousesController;
use Alegra\Model\WarehousesRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class WarehousesControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return WarehousesController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new WarehousesController($container->get(WarehousesRepositoryInterface::class));
    }
}