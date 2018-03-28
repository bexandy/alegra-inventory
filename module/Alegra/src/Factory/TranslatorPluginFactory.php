<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 27/03/18
 * Time: 12:39 PM
 */

namespace Alegra\Factory;


use Alegra\Plugin\TranslatePlugin;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TranslatorPluginFactory implements FactoryInterface
{
    protected $config;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        if (!$container->has('MvcTranslator')) {
            throw new \Exception('Zend I18n Translator not configured');
        }

        if (!$container->has('configuration')) {
            throw new \Exception('Global Configurator not configured');
        }

        $this->config = $container->get('configuration');
        $translator = $container->get('MvcTranslator');
        return new TranslatePlugin($translator, $this->config['translatable']);
    }

}