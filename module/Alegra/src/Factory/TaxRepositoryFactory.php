<?php

namespace Alegra\Factory;

use Alegra\Model\TaxRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


class TaxRepositoryFactory implements FactoryInterface
{
    protected $config;
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return TaxRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->config = $container->get('configuration');
        return new TaxRepository(
            $this->config['alegra']
        );
    }
}