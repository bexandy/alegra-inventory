<?php 

namespace Alegra\Factory;

use Alegra\Controller\ProductController;
use Alegra\Model\ProductRepositoryInterface;
use Alegra\Model\ProductCommandInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Alegra\Utility\Translatable;

class ProductControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ProductController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ProductController(
            $container->get(ProductRepositoryInterface::class),
            $container->get(ProductCommandInterface::class),
            $container->get(Translatable::class)
        );
    }
}