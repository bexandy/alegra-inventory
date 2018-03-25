<?php 

namespace Alegra\Factory;

use Alegra\Controller\CategoryController;
use Alegra\Model\CategoryRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CategoryControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return CategoryController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CategoryController($container->get(CategoryRepositoryInterface::class));
    }
}