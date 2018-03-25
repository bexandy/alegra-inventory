<?php

namespace Alegra\Factory;

use Alegra\Model\WarehousesRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class WarehousesRepositoryFactory implements FactoryInterface
{
    protected $config;
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return WarehousesRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->config = $container->get('configuration');
        return new WarehousesRepository(
            $this->config['alegra']
        );
    }
}