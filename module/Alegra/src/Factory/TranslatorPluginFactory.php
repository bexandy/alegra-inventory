<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 27/03/18
 * Time: 12:39 PM
 */

namespace Alegra\Factory;


use Alegra\Plugin\CurrencyConverterPlugin;
use Alegra\Plugin\TranslatePlugin;
use Alegra\Utility\DatabaseTranslationCommandInterface;
use Alegra\Utility\DatabaseTranslationLoader;
use Alegra\Utility\MyTranslator;
use Alegra\Utility\RealtimeTranslatorInterface;
use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\LoaderPluginManager;
use Zend\ServiceManager\Factory\FactoryInterface;

class TranslatorPluginFactory implements FactoryInterface
{
    protected $config;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
        if (!$container->has(MyTranslator::class)) {
            throw new \Exception('Zend I18n Translator not configured');
        }

        if (!$container->has('configuration')) {
            throw new \Exception('Global Configurator not configured');
        }

        $this->config = $container->get('configuration');
        $translator = $container->get(MyTranslator::class);
        $translator->setPluginManager(new LoaderPluginManager($container));
        $translator->getPluginManager()->setFactory(DatabaseTranslationLoader::class, DatabaseTranslationLoaderFactory::class);
        $realtimeTranslator = $container->get(RealtimeTranslatorInterface::class);
        $databaseTranslationCommand = $container->get(DatabaseTranslationCommandInterface::class);
        $currencyconverter = $container->get(CurrencyConverterPlugin::class);

        return new TranslatePlugin(
            $translator,
            $this->config['translatable'],
            $realtimeTranslator,
            $databaseTranslationCommand,
            $currencyconverter
        );
    }

}