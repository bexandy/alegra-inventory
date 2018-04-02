<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 02:10 PM
 */

namespace Alegra\Factory;


use Alegra\Utility\ApiYandex;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiYandexFactory implements FactoryInterface
{
    protected $config;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        $this->config = $container->get('configuration');
        return new ApiYandex(
            $this->config['translatable']['yandex_translator']
        );

    }

}