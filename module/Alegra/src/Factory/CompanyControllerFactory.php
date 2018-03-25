<?php 

namespace Alegra\Factory;

use Alegra\Controller\CompanyController;
use Alegra\Model\CompanyRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CompanyControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return CompanyController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CompanyController($container->get(CompanyRepositoryInterface::class));
    }
}