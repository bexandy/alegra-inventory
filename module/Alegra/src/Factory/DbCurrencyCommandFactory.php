<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 06/04/18
 * Time: 06:35 PM
 */

namespace Alegra\Factory;


use Alegra\Utility\DbCurrencyCommand;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DbCurrencyCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        $DbAdapter = $container->get(AdapterInterface::class);
        return new DbCurrencyCommand($DbAdapter);
    }

}