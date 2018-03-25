<?php

namespace Alegra\Factory;

use Alegra\Model\PriceListRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class PriceListRepositoryFactory implements FactoryInterface
{
    protected $config;
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return PriceListRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->config = $container->get('configuration');
        return new PriceListRepository(
            $this->config['alegra']
        );
    }
}