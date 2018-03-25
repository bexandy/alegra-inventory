<?php

namespace Alegra\Factory;

use Alegra\Model\ProductRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class ProductRepositoryFactory implements FactoryInterface
{
    protected $config;
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ProductRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->config = $container->get('configuration');
        return new ProductRepository(
            $this->config['alegra']
        );
    }
}