<?php

namespace Alegra;

use Zend\Router\Http\Literal;
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
    // Add this section:
    'service_manager' => [
        'aliases' => [
            Model\CategoryRepositoryInterface::class => Model\CategoryRepository::class,
            Model\CompanyRepositoryInterface::class => Model\CompanyRepository::class,
            Model\PriceListRepositoryInterface::class => Model\PriceListRepository::class,
            Model\TaxRepositoryInterface::class => Model\TaxRepository::class,
            Model\WarehousesRepositoryInterface::class => Model\WarehousesRepository::class,
            Model\ProductRepositoryInterface::class => Model\ProductRepository::class,
            Model\ProductCommandInterface::class => Model\ProductCommand::class,
        ],
        'factories' => [
            Model\CategoryRepository::class => Factory\CategoryRepositoryFactory::class,
            Model\CompanyRepository::class => Factory\CompanyAlegraRepositoryFactory::class,
            Model\PriceListRepository::class => Factory\PriceListRepositoryFactory::class,
            Model\TaxRepository::class => Factory\TaxRepositoryFactory::class,
            Model\WarehousesRepository::class => Factory\WarehousesRepositoryFactory::class,
            Model\ProductRepository::class => Factory\ProductRepositoryFactory::class,
            Model\ProductCommand::class => Factory\ProductCommandFactory::class,
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
    // This lines opens the configuration for the RouteManager
    'router' => [
        'routes' => [
            // This is the name of the route. For this example it's irrelevant
            // but it is useful to refer to this specific route programatically
            // with various helper methods that the framework provides.
            'api-company' => [
                // The type of the route is "Segment" because we are
                // using segments that will be mapped to function parameters.
                // E.g. the id
                'type'    => Literal::class,
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
                        'action'     => 'index',
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
];