<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 10:55 PM
 */

namespace Alegra\Factory;


use Alegra\Plugin\CurrencyConverterPlugin;
use Alegra\Utility\CurrencyExchangeRateInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CurrencyConverterPluginFactory implements FactoryInterface
{
    protected $config;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        $currencyExchangeRate = $container->get(CurrencyExchangeRateInterface::class);

        return new CurrencyConverterPlugin($currencyExchangeRate);
    }

}