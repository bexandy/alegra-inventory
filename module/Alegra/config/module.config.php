<?php

namespace Alegra;

use Alegra\Factory\DatabaseTranslationCommandFactory;
use Alegra\Factory\MyTranslatorServiceFactory;
use Alegra\Factory\TranslatorPluginFactory;
use Alegra\Utility\DatabaseTranslationCommand;
use Alegra\Utility\DatabaseTranslationCommandInterface;
use Alegra\Utility\DatabaseTranslationLoader;
use Alegra\Utility\MyTranslator;
use Alegra\Utility\RealtimeTranslatorInterface;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),
    ),
    'service_manager' => [
        'aliases' => [
            Model\CategoryRepositoryInterface::class => Model\CategoryRepository::class,
            Model\CompanyRepositoryInterface::class => Model\CompanyRepository::class,
            Model\PriceListRepositoryInterface::class => Model\PriceListRepository::class,
            Model\TaxRepositoryInterface::class => Model\TaxRepository::class,
            Model\WarehousesRepositoryInterface::class => Model\WarehousesRepository::class,
            Model\ProductRepositoryInterface::class => Model\ProductRepository::class,
            Model\ProductCommandInterface::class => Model\ProductCommand::class,
            RemoteLoaderInterface::class => Utility\DatabaseTranslationLoader::class,
            RealtimeTranslatorInterface::class => Utility\ApiYandex::class,
            DatabaseTranslationCommandInterface::class => DatabaseTranslationCommand::class
        ],
        'factories' => [
            Model\CategoryRepository::class => Factory\CategoryRepositoryFactory::class,
            Model\CompanyRepository::class => Factory\CompanyAlegraRepositoryFactory::class,
            Model\PriceListRepository::class => Factory\PriceListRepositoryFactory::class,
            Model\TaxRepository::class => Factory\TaxRepositoryFactory::class,
            Model\WarehousesRepository::class => Factory\WarehousesRepositoryFactory::class,
            Model\ProductRepository::class => Factory\ProductRepositoryFactory::class,
            Model\ProductCommand::class => Factory\ProductCommandFactory::class,
            Utility\DatabaseTranslationLoader::class => Factory\DatabaseTranslationLoaderFactory::class,
            Utility\ApiYandex::class => Factory\ApiYandexFactory::class,
            DatabaseTranslationCommand::class => DatabaseTranslationCommandFactory::class,
            MyTranslator::class => MyTranslatorServiceFactory::class

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\HomeController::class => InvokableFactory::class,
            Controller\CategoryController::class => Factory\CategoryControllerFactory::class,
            Controller\CompanyController::class => Factory\CompanyControllerFactory::class,
            Controller\PriceListController::class => Factory\PriceListControllerFactory::class,
            Controller\TaxController::class => Factory\TaxControllerFactory::class,
            Controller\WarehousesController::class => Factory\WarehousesControllerFactory::class,
            Controller\ProductController::class => Factory\ProductControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            // This is the name of the route. For this example it's irrelevant
            // but it is useful to refer to this specific route programatically
            // with various helper methods that the framework provides.
            'api-company' => [
                // The type of the route is "Segment" because we are
                // using segments that will be mapped to function parameters.
                // E.g. the id
                'type'    => Segment::class,
                'options' => [
                    // Requests to this URL will map to our RESTful controller.
                    // Requests to /api/company/id and /api/company will match.
                    // Notice how the id section is optional. The /api/company will
                    // match GET (for all companies) and POST while /api/company/id will
                    // match GET (for one company), PUT and DELETE.
                    'route'    => '/api/company',
                    'defaults' => [
                        // This is our controller's class. We use this to tell
                        // the router that we want this controller to handle
                        // requests to this route.
                        'controller' => Controller\CompanyController::class,
                    ],
                ],
            ],
            'api-product' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/product[/:id]',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                    ],
                ],
            ],
            'api-category' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/categories[/:id]',
                    'defaults' => [
                        'controller' => Controller\CategoryController::class,
                    ],
                ],
            ],
            'api-pricelist' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/price-list[/:id]',
                    'defaults' => [
                        'controller' => Controller\PriceListController::class,
                    ],
                ],
            ],
            'api-tax' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/taxes[/:id]',
                    'defaults' => [
                        'controller' => Controller\TaxController::class,
                    ],
                ],
            ],
            'api-warehouses' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/warehouses[/:id]',
                    'defaults' => [
                        'controller' => Controller\WarehousesController::class,
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'translator' => [
        'locale' => 'es_ES',
        'translation_file_patterns' => [
            [
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.lang.php',
            ],
        ],
        'remote_translation' => [
            [
                'type'     => DatabaseTranslationLoader::class,

            ],
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            'translator' => TranslatorPluginFactory::class,
        ],
    ],
];