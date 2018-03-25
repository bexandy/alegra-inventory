<?php 

namespace Alegra\Factory;

use Alegra\Controller\TaxController;
use Alegra\Model\TaxRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TaxControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return TaxController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TaxController($container->get(TaxRepositoryInterface::class));
    }
}