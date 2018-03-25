<?php 

namespace Alegra\Factory;

use Interop\Container\ContainerInterface;
use Alegra\Model\CompanyAlegraRepository;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\Server\Reflection\ReflectionClass;
use Zend\ServiceManager\Factory\FactoryInterface;


class CompanyAlegraRepositoryFactory implements FactoryInterface
{
    protected $config;
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return CompanyAlegraRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->config = $container->get('configuration');
        return new CompanyAlegraRepository(
            new ReflectionHydrator(),
            $this->config['alegra']
        );
    }
}    