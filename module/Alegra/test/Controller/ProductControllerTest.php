<?php
namespace AlegraTest\Controller;

use Alegra\Controller\ProductController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ProductControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = false;
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    public function setUp()
    {
        $this->request    = new Request();
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            // Grabbing the full application configuration:
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));
        parent::setUp();
    }

    public function testGetListCanBeAccessed()
    {
        $result   = $this->dispatch('/api/product');
        $response = $this->getResponse();
 
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/api/product');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Alegra');
        $this->assertControllerName(ProductController::class);
        $this->assertControllerClass('ProductController');
        $this->assertMatchedRouteName('api-product');
    }
}