<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 10:50 PM
 */

namespace Alegra\Factory;


use Alegra\Utility\ApiCurrencyLayer;
use Alegra\Utility\DbCurrencyCommandInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiCurrencyLayerFactory implements FactoryInterface
{
    protected $config;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        $this->config = $container->get('configuration');
        $dbCurrencyCommand = $container->get(DbCurrencyCommandInterface::class);
        return new ApiCurrencyLayer(
            $this->config['translatable']['convert_currency'],
            $dbCurrencyCommand
        );
    }


}