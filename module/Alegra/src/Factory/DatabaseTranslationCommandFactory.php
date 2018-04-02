<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 03:07 PM
 */

namespace Alegra\Factory;


use Alegra\Utility\DatabaseTranslationCommand;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DatabaseTranslationCommandFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.

        $DbAdapter = $container->get(AdapterInterface::class);
        return new DatabaseTranslationCommand($DbAdapter);
    }

}