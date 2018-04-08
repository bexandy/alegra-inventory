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
        )
    {
        $this->productRepository = $productRepository;
        $this->productCommand = $productCommand;
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
            $data = $products->toArray();

            foreach ($data as $key => $product)
            {
                $product['tax'] = $this->array_filter_recursive($product['tax']);
                $product['inventory'] = $this->array_filter_recursive($product['inventory']);
                $product['price'] = $this->array_filter_recursive($product['price']);
                $product['category'] = $this->array_filter_recursive($product['category']);
                $product = $this->array_filter_recursive($product);
                $data[$key] = $product;
            }

            $data = $this->translator()->toEnglish($data);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($products, 'default','en_US');
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }


    public function get($id)
    {

        $product = $this->productRepository->findProduct($id);

        if ($product instanceof Product) {
            $arreglo = $product->toArray();

            $arreglo['tax'] = $this->array_filter_recursive($arreglo['tax']);
            $arreglo['inventory'] = $this->array_filter_recursive($arreglo['inventory']);
            $arreglo['price'] = $this->array_filter_recursive($arreglo['price']);
            $arreglo['category'] = $this->array_filter_recursive($arreglo['category']);
            $arreglo = $this->array_filter_recursive($arreglo);

            
            $data = $this->translator()->toEnglish($arreglo);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        }
        else {
            $message = $this->translator()->translate($product);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }

    // POST /product
    // Creates a new product
    // The $data parameter is automatically mapped from the request body
    public function create($data)
    {

        $decode = $this->translator()->toSpanish($data);

        unset($decode['id']);

        if (! $decode)
            return $this->notFound();

        $hydrator = new  ProductHydrator();
        $product = $hydrator->hydrate( $decode,new Product());

        $enviar = $this->productCommand->insertProduct($product);

        if ($enviar instanceof Product) {
            $arreglo = $enviar->toArray();

            $arreglo['tax'] = $this->array_filter_recursive($arreglo['tax']);
            $arreglo['inventory'] = $this->array_filter_recursive($arreglo['inventory']);
            $arreglo['price'] = $this->array_filter_recursive($arreglo['price']);
            $arreglo['category'] = $this->array_filter_recursive($arreglo['category']);
            $arreglo = $this->array_filter_recursive($arreglo);

            $data = $this->translator()->toEnglish($arreglo);
            $this->getResponse()->setStatusCode(200);

            return new JsonModel([
                'success' => true,
                'data' => $data
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
        //$product = $hydrator->hydrate( ['id' => $id], new Product());
        $product = new Product();
        $product->setId($id);

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

        $data = $this->translator()->toSpanish($data);

        if (! $data)
            return $this->notFound();

        $hydrator = new  ProductHydrator();
        $product = $hydrator->hydrate( $data, new Product());

        $product->setId(intval($resource));

        $enviar = $this->productCommand->updateProduct($product);

        if ($enviar instanceof Product) {
            $arreglo = $enviar->toArray();

            $arreglo['tax'] = $this->array_filter_recursive($arreglo['tax']);
            $arreglo['inventory'] = $this->array_filter_recursive($arreglo['inventory']);
            $arreglo['price'] = $this->array_filter_recursive($arreglo['price']);
            $arreglo['category'] = $this->array_filter_recursive($arreglo['category']);
            $arreglo = $this->array_filter_recursive($arreglo);

            $data = $this->translator()->toEnglish($arreglo);
            $this->getResponse()->setStatusCode(200);
            return new JsonModel([
                'success' => true,
                'data' => $arreglo
            ]);
        }
        else {
            $message = $this->translator()->translate($enviar, 'default','en_US');
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }

    }

    function array_filter_recursive($input)
    {
        foreach ($input as &$value)
        {
            if (is_array($value))
            {
                if (empty($value))
                    $value = null;
                else
                    $value = $this->array_filter_recursive($value);
            }
        }

        $filter = array_filter($input);
        return $filter;
    }

}