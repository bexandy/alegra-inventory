<?php

namespace Alegra\Controller;

use Alegra\Hydrator\ProductHydrator;
use Alegra\Model\Product;
use Alegra\Model\ProductCommandInterface;
use Alegra\Model\ProductRepositoryInterface;
//use Alegra\Utility\Translatable;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ProductController extends AbstractRestfulController
{
	/**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    private $productCommand;
  //  private $traductor;

    public function __construct(
            ProductRepositoryInterface $productRepository, 
            ProductCommandInterface $productCommand
           // Translatable $traductor
        )
    {
        $this->productRepository = $productRepository;
        $this->productCommand = $productCommand;
    //    $this->traductor = $traductor;
    }

    private function notFound()
    {
        $this->getResponse()->setStatusCode(404);
        return new JsonModel([
            'success' => false,
            'message' => 'Not found'
        ]);
    }


    public function getList()
    {
        $products = $this->productRepository->findAllProducts();

        if ($products instanceof HydratingResultSet)
        {
            $test = $products->toArray();
            $decode = $this->array_filter_recursive_from_alegra($test);

            $data = $decode;
            //$traductor = $this->traductor;
            //$data = $traductor->toEnglish($decode);

            $this->getResponse()->setStatusCode(200);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);

            return $json;

        } else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $products
            ]);
        }
    }


    public function get($id)
    {

        $product = $this->productRepository->findProduct($id);

        if ($product instanceof Product) {
            $arreglo = $product->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $arreglo
            ]);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $product
            ]);
        }
    }

    // POST /product
    // Creates a new product
    // The $data parameter is automatically mapped from the request body
    public function create($data)
    {

        $decode = $this->array_filter_recursive_from_sencha($data);
        unset($decode['id']);
        if (! $decode)
            return $this->notFound();

        $hydrator = new  ProductHydrator();
        $product = $hydrator->hydrate( $decode,new Product());

        $enviar = $this->productCommand->insertProduct($product);

        if ($enviar instanceof Product) {
            $arreglo = $enviar->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $arreglo
            ]);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $enviar
            ]);
        }

    }

    public function delete($id)
    {
        $hydrator = new  ProductHydrator();
        $product = $hydrator->hydrate( ['id' => $id], new Product());

        $delete = $this->productCommand->deleteProduct($product);

        if ($delete['code'] == '200') {
            $this->getResponse()->setStatusCode(200);
            return new JsonModel([
                'success' => true,
                'message' => $delete
            ]);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $delete
            ]);
        }

    }

    public function update($id, $data)
    {
        $resource = $id;

        $data = $this->convert_to_null($data);

        if (! $data)
            return $this->notFound();

        $hydrator = new  ProductHydrator();
        $product = $hydrator->hydrate( $data, new Product());

        $product->setId($resource);

        $enviar = $this->productCommand->updateProduct($product);

        if ($enviar instanceof Product) {
            $arreglo = $enviar->toArray();
            $this->getResponse()->setStatusCode(200);
            return new JsonModel([
                'success' => true,
                'data' => $arreglo
            ]);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $enviar
            ]);
        }

    }


    function array_filter_recursive_from_sencha($input)
    {
        foreach ($input as &$value)
        {
            if (is_array($value))
            {
                $value = $this->array_filter_recursive_from_sencha($value);
            }
        }   

        $filter = array_filter($input, function($v){ return !is_null($v);});
        return $filter;
    }

    function array_filter_recursive_from_alegra($input)
    {
        foreach ($input as &$value)
        {
            if (is_array($value))
            {
                $value = $this->array_filter_recursive_from_alegra($value);
            }
        }   

        $filter = array_filter($input, function($v){ return is_null($v) || $v != '';});
        return $filter;
    }

    function convert_to_null($input)
    {
        foreach ($input as &$value)
            $value = ($value == '') ? null : $value;
        return $input;
    }

}