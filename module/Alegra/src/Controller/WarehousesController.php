<?php

namespace Alegra\Controller;

use Alegra\Model\Warehouses;
use Alegra\Model\WarehousesRepositoryInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class WarehousesController extends AbstractRestfulController
{
	/**
     * @var WarehousesRepositoryInterface
     */
    private $warehousesRepository;

    public function __construct(WarehousesRepositoryInterface $warehousesRepository)
    {
        $this->warehousesRepository = $warehousesRepository;
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
        $warehouses = $this->warehousesRepository->findAllWarehouses();
        $array = $warehouses->toArray();
        $json = new JsonModel([
            'success' => true,
            'data' => $array
        ]);

        return $json;
    }


    public function get($id)
    {

        $warehouse = $this->warehousesRepository->findWarehouse($id);

        if ($warehouse instanceof Warehouses) {
            $array = $warehouse->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $array
            ]);
        }
        else {
            return $this->notFound(); // Return a 404 if the warehouse is not found
        }
    }

}