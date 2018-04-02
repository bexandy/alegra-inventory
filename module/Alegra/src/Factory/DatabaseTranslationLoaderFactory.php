<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 31/03/18
 * Time: 11:30 AM
 */

namespace Alegra\Factory;

use Alegra\Utility\DatabaseTranslationLoader;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DatabaseTranslationLoaderFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method
        $DbAdapter = $container->get(AdapterInterface::class);
        return new DatabaseTranslationLoader($DbAdapter);
    }

}