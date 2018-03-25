<?php 

namespace Alegra\Factory;

use Alegra\Controller\PriceListController;
use Alegra\Model\PriceListRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PriceListControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return PriceListController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PriceListController($container->get(PriceListRepositoryInterface::class));
    }
}